<div class="container text-center text-warning">
    <h1><?= $_SESSION['confirmation_paiement']; ?>
        <?php unset($_SESSION['confirmation_paiement']); ?>
    </h1>
    <p>
        À très vite chez
        <span class="titre-site">Le Naturel Au Vert</span>
    </p>
    <a href="<?= addLink('home', 'index'); ?>" class="text-warning">Retour à l'accueil</a>
</div>
