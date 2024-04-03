<?php
if (empty($_SESSION['cart']) || !isset($_SESSION['cart'])) {
    ; ?>
    <div class="container-height">
        <div class="panier-vide-div">
            <h1 class="text-warning">Ohhh ... votre panier est vide ... Pourquoi ne pas aller le remplir ?</h1>
            <a href="<?= addLink('home', 'index') ?>">
                Suivez nous !
                <i class="fa-solid fa-arrow-right" style="color: #d40c0c;"></i>
            </a>
        </div>
    </div>
<?php } else { ?>
    <div class="table_panier_div container-height">
        <table class="table mt-4 table_panier">
            <thead>
                <tr>
                    <th scope="col">Image_produit</th>
                    <th scope="col">Produit</th>
                    <th scope="col">Prix Unitaire</th>
                    <th scope="col">Quantité</th>
                    <th scope="col">Total</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produits as $p) { ?>
                    <tr class="delete_article">
                        <td>
                            <a href="<?= addLink('home', 'details', $p['id']) ?>&categorie=<?= $p['categorie'] ?>"><img
                                    src="<?= $p['cheminDossier'] . $p['image'] ?>" alt="<?= $p['nom']; ?>"
                                    data-categorie="<?= $p['categorie']; ?>" /></a>
                        </td>
                        <td>
                            <?= $p['nom']; ?>
                        </td>
                        <td>
                            <?= $p['prix']; ?>€
                        </td>
                        <td class="quantite-input" id="quantite-<?= $p['id']; ?>">
                            <button type="button" data-article="<?= $p['id']; ?>" class="quantity-change moins none"
                                data-delta="-1">-</button>
                            <input type="text" value="<?= $p['nbArticles'] ?>" data-article="<?= $p['id'] ?>" class="quantity"
                                name="quantity_produit" id="quantity-<?= $p['id'] ?>" data-lot="<?= $p['lot']; ?>" />
                            <button type="button" data-article="<?= $p['id'] ?>" class="quantity-change plus none"
                                data-delta="1">+</button>
                        </td>
                        <td class="total-column">
                            <?= $p['prix'] ?>
                            €
                        </td>
                        <td class="">
                            <a id="link-supp" class="supprimer_article"
                                onclick="supprimerArticleDuPanier('<?= addLink('panier', 'delete', $p['id']); ?>')">Supprimer</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4">Total général :</th>
                    <td class="total-column" id="total-general">
                        <?= $_SESSION['totalGeneral'] ?>
                        €
                    </td>
                    <td>
                        <a id="commander">Passer la commande</a>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
<?php } ?>