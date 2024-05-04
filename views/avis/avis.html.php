<div class="achat-accueil <?= $css ?> bg-details container-height avis_div">
    <div id="image_produit_avis">
        <img src="<?= $cheminDossier . $produit->getImage() ?>" alt="">
    </div>
    <div id="text_produit_avis">
        <div class="titre_avis">
            <h2> Avis laissés sur <?= $produit->getNomProduit(); ?></h2>
        </div>
        <div class="avis_notes">
            <?php foreach ($avis as $a) { ?>
                <p>Avis laissé par : <?= $a['nom'] ?> <?= $a['prenom']; ?><span style="color: #FFC107"><?= htmlspecialchars_decode($a['note']); ?></span></p>
                <p><?= $a['avis']; ?></p>
            <?php } ?>
        </div>
    </div>
</div>