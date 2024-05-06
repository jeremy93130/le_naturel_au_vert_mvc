<div class="achat-accueil <?= $css ?> bg-details container-height">
    <div id="image_produit_avis">
        <img src="<?= $cheminDossier . $produit->getImage() ?>" alt="">
    </div>
    <div id="text_produit_avis">
        <div class="titre_avis">
            <h2> Avis laissés sur <?= $produit->getNomProduit(); ?></h2>
        </div>
        <div class="avis_notes">
            <?php foreach ($avis as $index => $a) { ?>
                <div class="commentaires_avis">
                    <p><?= ucfirst($a->nom); ?> <?= $a->prenom; ?><span>
                        <?= htmlspecialchars_decode($etoile[$index]); ?></span></p>
                    <p>le : <?= $a->getDate_Avis(); ?></p>
                    <p class="avis_p"><?= $a->getAvis(); ?></p>
                </div>
            <?php } ?>
        </div>
    </div>
</div>