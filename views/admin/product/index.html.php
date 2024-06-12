<div class="achat-accueil <?= $css ?> container-height relative">
    <div class="d-flex justify-content-end w-25" id="relative-div">
        <input type="search" name="plante_search" id="plante_search" placeholder="Recherche" />
    </div>
    <div class="produits-categories padding-bot">
        <div class="d-flex flex-wrap justify-content-center">
            <?php foreach ($products as $produit) {
            ?>
                <div class="card m-5 plantesResults relative-div-achats" style="width: 18rem;" data-nom="<?= $produit->getNomProduit(); ?>">
                    <div class="img-card">
                        <img src="<?= htmlspecialchars($cheminDossier[$produit->getId()] . $produit->getImage()) ?>" class="card-img-top" alt="<?= $produit->getNomProduit(); ?>" />
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title">
                            <?= $produit->getNomProduit(); ?>
                        </h5>
                        <a href="<?= addLink('admin/produits', 'edit', $produit->getId()) ?>" class="btn btn-warning change-btn">Modifier ce produit</a>
                        <a href="<?= addLink('admin/produits', 'delete', $produit->getId()) ?>" class="btn btn-warning change-btn mt-4">Supprimer ce produit</a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>