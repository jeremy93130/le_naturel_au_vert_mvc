<?php
if (empty($_SESSION['cart']) || !isset($_SESSION['cart'])) {; ?>
    <div class="container-height">
        <div class="panier-vide-div">
            <h1 class="text-warning">Ohhh ... votre panier est vide ... Pourquoi ne pas aller le remplir ?</h1>
            <a href="<?= addLink('home', 'index') ?>">
                Suivez nous !
                <i class="fa-solid fa-arrow-right" style="color: #d40c0c;"></i>
            </a>
        </div>
    </div><?php } else { ?>
    <div class="table_panier_div container-height">
        <div>
            <?php foreach ($produits as $p) { ?>
                <div class="mobile_panier text-warning">
                    <div class="img_panier_mobile">
                        <img src="<?= $p['cheminDossier'] . $p['image'];  ?>" alt="<?= $p['nom']; ?>">
                    </div>
                    <div class="text_panier_mobile">
                        <h2><?= $p['nom']; ?></h2>
                        <p><?= $p['prix']; ?></p>
                        <div class="quantite-input" id="quantite-<?= $p['id']; ?>">
                            <button type="button" data-article="<?= $p['id']; ?>" class="quantity-change moins none" data-delta="-1">-</button>
                            <input type="text" value="<?= $p['nbArticles'] ?>" data-article="<?= $p['id'] ?>" class="quantity" name="quantity_produit" id="quantity-<?= $p['id'] ?>" data-lot="<?= $p['lot']; ?>" />
                            <button type="button" data-article="<?= $p['id'] ?>" class="quantity-change plus none" data-delta="1">+</button>
                            <p class="total-column"><?= $p['prix']; ?></p>
                            <p><a class="link-supp" class="supprimer_article" onclick="supprimerArticleDuPanier('<?= addLink('panier', 'delete', $p['id']); ?>')"><i class="fa-regular fa-trash-can"></i></a></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div><?php } ?>