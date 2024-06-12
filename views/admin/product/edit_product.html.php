<div class="container-height text-warning">
    <h1 class="text-center">Modification du produit</h1>
    <h2 class="text-center">Que voulez-vous modifier sur <?= $product->getNomProduit() ?>?</h2>
    <div class="text-warning w-50 m-auto mt-5">
        <ul data-url='<?= addLink('admin/produits', 'edit'); ?>' data-id = "<?= $product->getId(); ?>">
            <li class="modif_produit">Le Nom
                <div class="none">
                    <input type="text" name="nom">
                    <button type="submit">Valider</button>
                </div>
            </li>
            <li class="modif_produit">La Description
                <div class="none">
                    <textarea name="description" id="description"></textarea>
                    <button type="submit">Valider</button>
                </div>
            </li>
            <li class="modif_produit">Le Prix
                <div class="none">
                    <input type="number" name="prix">
                    <button type="submit">Valider</button>
                </div>
            </li>
            <li class="modif_produit">Les Caractéristiques
                <div class="none">
                    <textarea name="caracteristique" id="caracteristiques"></textarea>
                    <button type="submit">Valider</button>
                </div>
            </li>
            <li class="modif_produit">L'Image
                <div class="none">
                    <input type="file" name="image">
                    <button type="submit">Valider</button>
                </div>
            </li>
            <li class="modif_produit">Le Stock
                <div class="none">
                    <input type="number" name="stock">
                    <button type="submit">Valider</button>
                </div>
            </li>
            <li class="modif_produit">L'Entretien
                <div class="none">
                    <textarea name="entretien" id="entretien"></textarea>
                    <button type="submit">Valider</button>
                </div>
            </li>
            <li class="modif_produit">La Catégorie
                <div class="none">
                    <select name="categorie" id="categorie">
                        <option value="0">...</option>
                        <option value="1">¨Categorie Plante</option>
                        <option value="2">¨Categorie Graine</option>
                        <option value="3">¨Categorie Légumes</option>
                        <option value="4">¨Categorie Fruits</option>
                    </select>
                    <button type="submit">Valider</button>
                </div>
            </li>
            <li class="modif_produit">Le Lot
                <div class="none">
                    <input type="number" name="lot">
                    <button type="submit">Valider</button>
                </div>
            </li>
        </ul>
        <div id="reponse"></div>
    </div>
</div>