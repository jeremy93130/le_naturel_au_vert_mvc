<div class="container-height text-warning">
    <h1 class="text-center">Ajout de produit</h1>
    <form method="post" enctype="multipart/form-data" class="text-warning w-50 m-auto">
        <div class="form-group mt-3">
            <label for="nom_admin">Nom du produit
                <sup>*</sup>
            </label>
            <input type="text" name="nom" id="nom_admin" class="form-control" required>
        </div>

        <div class="form-group mt-3">
            <label for="description_admin" class="d-block">Description du produit
                <sup>*</sup>
            </label>
            <textarea name="description" id="description_admin" cols="100" rows="4" required></textarea>
        </div>

        <div class="form-group mt-3">
            <label for="prix_admin">Prix du produit
                <sup>*</sup>
            </label>
            <input type="number" name="prix" id="prix_admin" class="form-control" required>
        </div>

        <div class="form-group mt-3">
            <label for="stock_admin">Stock produit
                <sup>*</sup>
            </label>
            <input type="text" name="stock" id="stock_admin" class="form-control" required>
        </div>

        <div class="form-group mt-3">
            <label for="image_admin">Image produit
                <sup>*</sup>
            </label>
            <input type="file" name="image" id="image_admin" class="form-control" required>
        </div>

        <div class="form-group mt-3">
            <label for="caracteristique_admin">
                Caracteristique
                <sup>*</sup>
            </label>
            <textarea name="caracteristique" id="caracteristique_admin" cols="100" rows="4" required></textarea>
        </div>
        <div class="form-group mt-3">
            <label for="entretien_admin">
                Entretien
                <sup>*</sup>
            </label>
            <textarea name="entretien" id="entretien_admin" cols="100" rows="4" required></textarea>
        </div>
        <div class="form-group mt-3">
            <label for="categorie_admin">
                Categorie
                <sup>*</sup>
            </label>
            <select name="categorie" id="categorie_admin" class="d-block w-100">
                <option value="1">Plante</option>
                <option value="2">Graines</option>
                <option value="3">Légumes</option>
                <option value="4">Fruits</option>
            </select>
        </div>
        <div class="form-group mt-3">
            <label for="lot_admin">
                Lot
                <sup>*</sup>
            </label>
            <input type="number" name="lot" id="lot_admin" class="form-control" required>
        </div>
        <div class="d-flex justify-content-between mt-3">
            <button type="submit" class="btn btn-primary" name="add_produit">Ajouter le produit</button>
            <a href="<?= addLink("home", 'index'); ?>" class="btn btn-danger">Annuler</a>
        </div>
    </form>
</div>