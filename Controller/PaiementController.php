<?php

namespace Controller;

use Model\Entity\Commande;
use Controller\BaseController;
use Model\Repository\AdresseRepository;
use Model\Repository\DetailCommandeRepository;
use Model\Repository\ProduitsRepository;
use Service\Session;
use Stripe\Stripe;

class PaiementController extends BaseController
{
    private AdresseRepository $adresseRepository;
    private Commande $commande;
    private ProduitsRepository $produitsRepository;
    private DetailCommandeRepository $detailCommandeRepository;

    public function __construct()
    {
        $this->commande = new Commande;
        $this->detailCommandeRepository = new DetailCommandeRepository;
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
        Stripe::setApiKey('sk_test_51OICEgC3GA5BR02Af7eTScs2GgI29d4FpjzMiWRo625SCPzvudJNRQPg0A3ICZ9wTnCiXJadx9TrO7MRr9lVaXV800sjafT7mP'); // Remplacez par votre clé secrète Stripe

        $adresseLivraison = $_SESSION['adresse_livraison'];
        $adresseFacturation = $_SESSION['adresse_facturation'];
        if (!isset($adresseLivraison) || !isset($adresseFacturation)) {
            $erreur_adresse = 'Merci d\'entrer une adresse valide avant de procéder au paiement !';
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
            'success_url' => $this->redirectToRoute(['paiement', 'handleSuccessfullPayment']),
            'cancel_url' => $this->redirectToRoute(['paiement', 'cancel']),
        ]);
        header('Location: ' . $checkout_session->url);
        exit;
    }
    public function handleSuccessfulPayment()
    {
        $_SESSION['adresseValide'] = false;

        $user = $this->getUser();

        // Récupérer les informations de la session
        $adresseInfo = $_SESSION['adresse_livraison'] ?? $this->adresseRepository->findByLastLivraison($user);

        $adresseFactureInfo = $_SESSION['adresse_facturation'] ?? $this->adresseRepository->findByLastFacture($user) ?? $adresseInfo;

        if (!empty($adresseFactureInfo) && is_array($adresseFactureInfo)) {
            $adresseFactureInfo['type'] = "facturation";
            unset($adresseFactureInfo['instructions']);
        }
        ;
        //Récuperer les plantes dans la session panier 
        $panier = $_SESSION['cart'];

        //Créer une nouvelle entité Commandes
        $commande = $this->commande;

        $total = 0;
        $quantiteTotale = 0;
        foreach ($panier['commandeData'] as $item) {
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

                    // Inserer les details dans la BDD
                    $this->detailCommandeRepository->insertDetail($produit, $commande, $quantite);
                }
            }
        }
        $commande->setTotal((float) number_format($total, 2));

        if (is_array($adresseInfo) && is_array($adresseFactureInfo)) {
            // On enregistre l'adresse de livraison et de facturation
            $this->adresseRepository->insertAdresse($adresseInfo);
            $this->adresseRepository->insertAdresse($adresseFactureInfo);
        }

        // Supprimer les éléments de la session panier
        Session::delete($_SESSION['panier']);

        // Marquer la variable de session pour indiquer que la redirection a eu lieu
        $_SESSION['redirected'] = true;

        // On remet le compteur des articles à 0
        $_SESSION['totalGeneral'] = 0;

        Session::delete($_SESSION['adresse_livraison']);
        Session::delete($_SESSION['adresse_facture']);

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
