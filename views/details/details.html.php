<div class="achat-accueil <?= $css ?> bg-details container-height">
  <div class="w-50 m-auto mt-5 details_mobile">
    <div class="card bg-transparent border border-0 relative-details">
      <div id="carouselExample" class="carousel slide">
        <div class="carousel-inner details-img">
          <div class="carousel-item active detail-img">
            <img src="<?= $cheminDossier . $detail->getImage(); ?>" class="d-block w-100" alt="<?= $detail->getNomProduit(); ?>"/>
          </div>
          <?php if ($item !== null) {
            foreach ($item as $i) { ?>
              <div class="carousel-item detail-img">
                <img src="<?= $cheminDossier . $detail->getImage(); ?>" class="d-block w-100" alt="<?= $detail->getNomProduit(); ?>"/>
              </div>
            <?php }
          } ?>
        </div>
        <button class="carousel-control-prev absolutePrev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next absoluteNext" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
      <div class="card-body bg-success details_mobile" style="width: 400px; margin:auto;">
        <h5 class="card-title"><?= $detail->getNomProduit() ?></h5>
        <div class="accordion accordion-flush bg-transparent" id="accordionFlushExample">
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">Description</button>
            </h2>
            <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">
                <p class="card-text" style="text-align:justify"><?= $detail->getDescriptionProduit(); ?></p>
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">Caractèristiques</button>
            </h2>
            <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">
                <p style="text-align:justify"><?= $detail->getCaracteristique(); ?></p>
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">Conseils d'Entretien</button>
            </h2>
            <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">
                <p style="text-align:justify"><?= $detail->getEntretien(); ?></p>
              </div>
            </div>
          </div>
          <?php if ($detail->getStock() > 0) { ?>
            <div class="mt-3 ps-3 d-flex w-100 justify-content-between">
              <a class="link-warning link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" id="ajouter_panier_link" data-url="<?= addLink('panier', 'addToCart'); ?>" data-id="<?= $detail->getId() ?>" data-nom="<?= $detail->getNomProduit(); ?>" data-prix="<?= $detail->getPrixProduit(); ?>" data-image="<?= $detail->getImage(); ?>">Ajouter au panier</a>

              <div>
                <span>Lot :</span>
                <span style="text-align: right;width: 50%; color:#FFC107"><?= $detail->getLot(); ?></span>
                <span>Stock :</span>
                <span style="text-align: right;width: 50%; color:#FFC107"><?= $detail->getStock(); ?></span>
              </div>
            </div>
          <?php } else { ?>
            <div>
              <p class="text-center mt-2 text-danger fw-bold">Ce produit est actuellement indisponible</p>
            </div>
          <?php } ?>
        </div>
        <span class="bg-warning absolutePrix" style="text-align:center"><?= $detail->getPrixProduit() ?>€</span>
        <?php if (isset($_SESSION['user']) && $_SESSION['user']->getRole() === '["ROLE_ADMIN"]') { ?>
          <form action="" method="post" enctype="multipart/form-data">
            <div class="add_image">
              <input type="file" name="imagePlante" accept="image/*"/>
              <button type="submit">Ajouter image</button>
            </div>
          </form>
        <?php } ?>
      </div>
    </div>
    <div id="ajout-panier"></div>
  </div>
</div>

