<?php

namespace Controller;

require_once 'vendor/autoload.php';
use Dotenv\Dotenv;
use Stripe\Stripe;
use Service\Session;
use Model\Entity\Commande;
use Service\AdresseManager;
use Controller\BaseController;
use Model\Repository\AdresseRepository;
use Model\Repository\CommandeRepository;
use Model\Repository\ProduitsRepository;
use Model\Repository\DetailCommandeRepository;

class PaiementController extends BaseController
{
    private AdresseRepository $adresseRepository;
    private ProduitsRepository $produitsRepository;
    private DetailCommandeRepository $detailCommandeRepository;
    private CommandeRepository $commandeRepository;
    private $user;

    public function __construct()
    {
        $this->detailCommandeRepository = new DetailCommandeRepository;
        $this->adresseRepository = new AdresseRepository;
        $this->produitsRepository = new ProduitsRepository;
        $this->commandeRepository = new CommandeRepository;
        $this->user = $this->getUser();
    }

    public function index()
    {
        $sessionCommande = $_SESSION['commande'];
        $user = $this->getUser();

        // Récupérer les informations nécessaires de la session ou ailleurs
        $successMessage = $_SESSION['success_url'] ?? null;

        return $this->render('commandes/commandes.html.twig', [
            'dataCommande' => $sessionCommande,
            'userInfo' => $user,
            'successMessage' => $successMessage,
        ]);
    }
    public function stripeCheckout()
    {
        // Chargez les variables d'environnement à partir du fichier .env
        $dotenv = Dotenv::createImmutable(dirname(__DIR__));
        $dotenv->load();

        // Maintenant, vous pouvez accéder à vos variables d'environnement comme suit
        $stripeSecretKey = $_ENV['CLE_SECRETE'];

        // Utilisez la clé secrète Stripe comme nécessaire
        Stripe::setApiKey($stripeSecretKey);

        $adresseLivraison = $_SESSION['adresse_livraison'] ?? $this->adresseRepository->findLastLivraison($this->user->getId());
        $adresseFacturation = $_SESSION['adresse_facturation'] ?? $this->adresseRepository->findLastFacturation($this->user->getId()) ?? $adresseLivraison;

        if (!empty($adresse_facturation) && $adresseFacturation == $adresseLivraison) {
            $adresseFacturation = AdresseManager::AdresseTableauOuObjet($adresseFacturation);
        }

        if (!isset($adresseLivraison) || !isset($adresseFacturation)) {
            $_SESSION['erreur_adresse'] = 'Merci d\'entrer une adresse valide avant de procéder au paiement !';
            return $this->redirectToRoute(['commande', 'recapp']);
        } else {
            $commandeData = $_SESSION['commande'];
            $totalData = $_SESSION['totalGeneral'];
            $lineItems = [];

            // Ajouter des frais de livraison si le total est inférieur à 50
            if ($totalData < 50) {
                $unitAmount = round(3.99 * 100);
                $lineItems[] = [
                    'price_data' => [
                        'currency' => 'eur',
                        'product_data' => [
                            'name' => 'Frais de livraison',
                        ],
                        'unit_amount' => $unitAmount, // Le prix doit être en centimes
                    ],
                    'quantity' => 1, // Vous pouvez ajuster la quantité si nécessaire
                ];
            }
            foreach ($commandeData as $item) {
                $unitAmount = round($item['prixTTC'] * 100);
                $lineItems[] = [
                    'price_data' => [
                        'currency' => 'eur',
                        'product_data' => [
                            'name' => $item['alt'],
                        ],
                        'unit_amount' => $unitAmount, // Le prix doit être en centimes
                    ],
                    'quantity' => $item['quantite'],
                ];
            }
        }
        $checkout_session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => "http://localhost/le_naturel_au_vert_mvc/paiement/handleSuccessfullPayment",
            'cancel_url' => "http://localhost/le_naturel_au_vert_mvc/paiement/cancelPayment"
        ]);
        header('Location: ' . $checkout_session->url);
        exit;
    }
    public function handleSuccessfullPayment()
    {
        // d_die('test');
        $_SESSION['adresseValide'] = false;
        $adresses = AdresseManager::checkAdresse($this->getUser()->getId(), $this->adresseRepository);

        if ($adresses) {
            $adresse_livraison = $adresses['livraison'];
            $adresse_facturation = $adresses['facturation'];

            $adresse_facturation->setType('facturation')
                ->setInstruction_livraison(null);
        } else {
            $adresse_livraison = null;
            $adresse_facturation = null;
        }
        // d_die($_SESSION['adresse_facturation']);
        // d_die($adresseFactureInfo);
        //Récuperer les plantes dans la session commande 
        $panier = $_SESSION['commande'];

        //Créer une nouvelle entité Commandes
        $commande = new Commande;
        $total = 0;
        $quantiteTotale = 0;
        foreach ($panier as $item) {
            $produit = $this->produitsRepository->findById('produits', $item['id']);
            if ($produit) {
                $quantite = $item['quantite'];
                $prix = $item['prixTTC'];
                $total += $quantite * $prix;
                // Accumuler la quantité totale
                $quantiteTotale += $quantite;

                // Vérifiez si le stock est suffisant
                if ($produit->getStock() >= $quantite) {
                    // Soustrayez la quantité du stock
                    $produit->setStock($produit->getStock() - $quantite);
                }
            }
        }
        $commande->setNumeroCommande();
        if ($total < 50) {
            $total += 3.99;
        }
        $commande->setTotal((float) number_format($total, 2));

        $commandeId = $this->commandeRepository->insertOrder($commande);

        // Ensuite, vous pouvez insérer les détails de la commande pour chaque produit
        foreach ($panier as $item) {
            $produit = $this->produitsRepository->findById('produits', $item['id']);
            if ($produit) {
                $quantite = $item['quantite'];
                $this->detailCommandeRepository->insertDetail($produit->getId(), $commandeId->getId(), $quantite);
            }
        }

        if ($adresse_livraison !== null && $adresse_facturation !== null) {
            // On enregistre l'adresse de livraison et de facturation
            $adresse_livraison->setCommandeId($commandeId->getId())
                ->setClient($this->getUser()->getId());
            $adresse_facturation->setCommandeId($commandeId->getId())
                ->setClient($this->getUser()->getId());
            $this->adresseRepository->insertAdresse($adresse_livraison);
            $this->adresseRepository->insertAdresse($adresse_facturation);
        }
        // Supprimer les éléments de la session panier
        Session::delete('cart');

        // Marquer la variable de session pour indiquer que la redirection a eu lieu
        $_SESSION['redirected'] = true;

        Session::delete('adresse_livraison');
        Session::delete('adresse_facture');
        Session::delete('commande');
        Session::delete('nombre');

        $_SESSION['confirmation_paiement'] = 'Votre paiement a bien été accepté, merci pour votre commande';

        $this->redirectToRoute(['commande', 'confirmation']);
    }

    public function cancelPayment()
    {
        Session::delete('commande');

        return $this->redirectToRoute(['home', 'index']);
    }
}
