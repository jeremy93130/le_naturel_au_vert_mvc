<?php //d_die($produits["produits"]);                            ?>
<div class="achat-accueil <?= $css ?> container-height relative">
	<div class="d-flex justify-content-center align-items-center block-mobile">
		<div class="titre-plante">
			<h2 class="text-center m-3 titre-site">Produits disponibles à l'achat</h2>
			<input type="search" name="plante_search" id="plante_search" placeholder="Recherche"/>
			<h3>Autres catégories</h3>
			<div class="categories">
				<?php if ($_SERVER['REQUEST_URI'] != ROOT . 'home/list/1') {
					; ?>
					<a class="nav-link text-warning dropdown-item" href="<?= addLink('home', 'list', 1) ?>">Plantes</a>
				<?php }
				if ($_SERVER['REQUEST_URI'] != ROOT . 'home/list/2') { ?>
						<a class="nav-link text-warning dropdown-item" href="<?= addLink('home', 'list', 2) ?>">Graines</a>
					<?php }
				if ($_SERVER['REQUEST_URI'] != ROOT . 'home/list/3') { ?>
							<a class="nav-link text-warning dropdown-item" href="<?= addLink('home', 'list', 3) ?>">Légumes</a>
						<?php }
				if ($_SERVER['REQUEST_URI'] != ROOT . 'home/list/4') { ?>
								<a class="nav-link text-warning dropdown-item" href="<?= addLink('home', 'list', 4) ?>">Fruits</a>
						<?php } ?>
					</div>
				</div>
			</div>
			<div class="d-flex justify-content-end w-25" id="relative-div"></div>
			<div class="produits-categories padding-bot">
				<div class="d-flex flex-wrap justify-content-center">
					<?php foreach ($produits as $produit) {
						if ($produit->getStock() > 0) {
							?>
								<div class="card m-5 plantesResults relative-div-achats" style="width: 18rem;" data-nom="<?= $produit->getNomProduit(); ?>">
									<div class="img-card">
										<img src="<?= $cheminDossier . $produit->getImage() ?>" class="card-img-top" alt="<?= $produit->getNomProduit(); ?>"/>
									</div>
									<div class="card-body text-center">
										<h5 class="card-title">
											<?= $produit->getNomProduit(); ?>
										</h5>
										<a href="<?= addLink('home', 'details', $produit->getId()) ?>" class="btn btn-warning change-btn">Voir l'article en détail</a>

									</div>
									<span class="ajouter_panier_icon" data-url="<?= addLink('panier', 'addToCart'); ?>" data-id="<?= $produit->getId() ?>" data-nom="<?= $produit->getNomProduit() ?>" data-prix="<?= $produit->getPrixProduit(); ?>" data-image="<?= $produit->getImage(); ?>">
										<i class="fa-solid fa-cart-plus <?= $cssRed[$produit->getId()] ?>"></i>
									</span>
									<span class="absolute-prix">
										<?= $produit->getPrixProduit(); ?>€
									</span>
								</div>
						<?php } else { ?>
								<div class="card m-5 plantesResults relative-div-achats" style="width: 18rem;" data-nom="<?= $produit->getNomProduit(); ?>">
									<div class="img-card">
										<img src="<?= $cheminDossier . $produit->getImage() ?>" class="card-img-top img-hors-stock" alt="<?= $produit->getNomProduit(); ?>"/>
										<h6 id="hors-stock">Hors Stock, bientot disponible</h6>
									</div>
									<div class="card-body text-center">
										<h5 class="card-title">
											<?= $produit->getNomProduit(); ?>
										</h5>
										<a href="<?= addLink('home', 'details', $produit->getId()) ?>" class="btn btn-warning change-btn">Voir l'article en détail</a>
									</div>
								</div>
						<?php }
					} ?>
				</div>
			</div>
			<div class='pagination_num'>
				<?php
				// Afficher les liens de pagination
				if ($pageCourante != 1): ?>
					<a href="<?= addLink('home', 'list', $categorie) ?>?page=<?= $pageCourante - 1 ?>" id="previous">Page
																précedente</a>
				<?php endif;

				if ($pageCourante < ceil($totalProduits / $produitsParPage)): ?>
					<a href="<?= addLink('home', 'list', $categorie) ?>?page=<?= $pageCourante + 1 ?>" id="next">Page suivante</a>
				<?php endif; ?>
			</div>
		</div>

