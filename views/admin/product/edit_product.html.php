<div class="container-height text-warning">
    <h1 class="text-center">Modification du produit</h1>
    <h2 class="text-center">Que voulez-vous modifier sur <?= $product->getNomProduit() ?>?</h2>
    <form method="post" enctype="multipart/form-data" id="form_update_product_admin" class="text-warning w-50 m-auto">
        <ul>
            <li>Le Nom
                <div class="none">
                    <input type="text">
                    <button type="submit">Valider</button>
                </div>
            </li>
            <li>La Description
                <div class="none">
                    <textarea name="description" id="description"></textarea>
                    <button type="submit">Valider</button>
                </div>
            </li>
            <li>Le Prix
                <div class="none">
                    <input type="number">
                    <button type="submit">Valider</button>
                </div>
            </li>
            <li>Les Caractéristiques
                <div class="none">
                    <textarea name="caracteristique" id="caracteristiques"></textarea>
                    <button type="submit">Valider</button>
                </div>
            </li>
            <li>L'Image
                <div class="none">
                    <input type="file">
                    <button type="submit">Valider</button>
                </div>
            </li>
            <li>Le Stock
                <div class="none">
                    <input type="number">
                    <button type="submit">Valider</button>
                </div>
            </li>
            <li>L'Entretien
                <div class="none">
                    <textarea name="entretien" id="entretien"></textarea>
                    <button type="submit">Valider</button>
                </div>
            </li>
            <li>La Catégorie
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
            <li>Le Lot
                <div class="none">
                    <input type="number">
                    <button type="submit">Valider</button>
                </div>
            </li>
        </ul>
    </form>
</div>