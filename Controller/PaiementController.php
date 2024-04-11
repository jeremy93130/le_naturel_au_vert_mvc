<?php

namespace Controller;

require_once 'vendor/autoload.php';
use Stripe\Stripe;
use Service\Session;
use Model\Entity\Commande;
use Controller\BaseController;
use Model\Entity\Adresse;
use Model\Repository\AdresseRepository;
use Model\Repository\CommandeRepository;
use Model\Repository\ProduitsRepository;
use Model\Repository\DetailCommandeRepository;
use Service\AdresseManager;

class PaiementController extends BaseController
{
    private AdresseRepository $adresseRepository;
    private Commande $commande;
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
        $stripeSecretKey = getenv('STRIPE_SECRET_KEY');;
        Stripe::setApiKey($stripeSecretKey); // Remplacez par votre clé secrète Stripe

        $adresseLivraison = $_SESSION['adresse_livraison'] ?? $this->adresseRepository->findLastLivraison($this->user);
        $adresseFacturation = $_SESSION['adresse_facturation'] ?? $this->adresseRepository->findLastFacturation($this->user) ?? $adresseLivraison;

        if (!empty($adresse_facturation) && $adresseFacturation == $adresseLivraison) {
            $adresseFacturation = AdresseManager::AdresseTableauOuObjet($adresseFacturation);
        }

        if (!isset($adresseLivraison) || !isset($adresseFacturation)) {
            $_SESSION['erreur_adresse'] = 'Merci d\'entrer une adresse valide avant de procéder au paiement !';
            return $this->redirectToRoute(['commande', 'recapp']);
        } else {
            $commandeData = $_SESSION['commande'];
            // dd($commandeData);
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
        // Récupérer les informations de la session
        $adresseInfo = $_SESSION['adresse_livraison'] ?? $this->adresseRepository->findLastLivraison($this->user);
        $adresseFactureInfo = $_SESSION['adresse_facturation'] ?? $this->adresseRepository->findLastFacturation($this->user) ?? $adresseInfo;
        if (!empty($adresseFactureInfo) && is_array($adresseFactureInfo)) {
            $adresseFactureInfo['type'] = "facturation";
            unset($adresseFactureInfo['instructions']);
        }
        ;
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
        $commande->setTotal((float) number_format($total, 2));

        $this->commandeRepository->insertOrder($commande);

        // Maintenant que la commande est insérée, vous pouvez obtenir son ID
        $commandeId = $commande->getId();

        // Ensuite, vous pouvez insérer les détails de la commande pour chaque produit
        foreach ($panier as $item) {
            $produit = $this->produitsRepository->findById('produits', $item['id']);
            if ($produit) {
                $quantite = $item['quantite'];
                $this->detailCommandeRepository->insertDetail($produit->getId(), $commandeId, $quantite);
            }
        }

        if (is_array($adresseInfo) && is_array($adresseFactureInfo)) {
            // On enregistre l'adresse de livraison et de facturation
            $this->adresseRepository->insertAdresse($adresseInfo);
            $this->adresseRepository->insertAdresse($adresseFactureInfo);
        }


        d_die($panier);
        // Supprimer les éléments de la session panier
        Session::delete($_SESSION['panier']);

        // Marquer la variable de session pour indiquer que la redirection a eu lieu
        $_SESSION['redirected'] = true;

        // On remet le compteur des articles à 0
        $_SESSION['totalGeneral'] = 0;

        Session::delete($_SESSION['adresse_livraison']);
        Session::delete($_SESSION['adresse_facture']);
        Session::delete($_SESSION['commande']);

        // Ajout d'un message flash pour informer l'utilisateur
        $this->setMessage('success', 'Votre paiement a bien été accepté, merci pour votre commande');

        $this->redirectToRoute(['commande', 'recapp']);
    }

    public function cancelPayment()
    {
        Session::delete($_SESSION['commande']);

        return $this->redirectToRoute(['home', 'index']);
    }
}
