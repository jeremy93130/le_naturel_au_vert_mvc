<div class="achat-accueil <?= $css ?> bg-details container-height">
    <div id="image_produit_avis">
        <img src="<?= $cheminDossier . $produit->getImage() ?>" alt="">
    </div>
    <div id="text_produit_avis">
        <div class="titre_avis">
            <h2> Ce que les acheteurs pensent de <?= $produit->getNomProduit(); ?></h2>
            <p><a href="<?= addLink('avis', 'new', $produit->getId()); ?>">Laissez mon avis</a></p>
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