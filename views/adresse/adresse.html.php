<div class="container-height">
  <div class="adresse_livraison">
    <h1>Veuillez inscrire vos informations de livraison</h1>
    <form method="POST">
      <div class="mb-3">
        <label for="nomComplet" class="form-label">Nom de l'adresse</label>
        <input type="text" class="form-control" id="nomComplet" name="nomComplet">
      </div>
      <div class="mb-3">
        <label for="adresse" class="form-label">Emplacement de l'adresse
        </label>
        <input type="text" class="form-control" id="exampleInputPassword1" name="adresse">
      </div>
      <div class="mb-3">
        <label for="codePostal" class="form-label">Code Postal</label>
        <input type="number" class="form-control" id="codePostal" name="codePostal">
      </div>
      <div class="mb-3">
        <label for="ville">Ville</label>
        <select name="ville" id="ville">
          <?php foreach ($villes as $value) { ?>
              <option value="<?= $value['city'] ?>"><?= $value['city'] ?></option>
          <?php } ?>
        </select>
      </div>
      <div class="mb-3">
        <label for="pays" class="form-label">Pays</label>
        <select name="pays" id="pays">
          <?php foreach ($pays as $codePays => $p) { ?>
              <option value="<?= $p ?>"><?= $p; ?></option>
          <?php } ?>
        </select>
      </div>
      <div class="mb-3">
        <label for="telephone" class="form-label">Numero de téléphone</label>
        <input type="number" class="form-control" id="telephone" name="telephone">
      </div>
      <div class="mb-3">
        <label for="instructions" class="form-label">Instructions de livraison (facultatif)</label>
        <textarea name="instructions" id="instructions" cols="80" rows="5"></textarea>
      </div>
      <button type="submit" class="btn btn-primary" name="confirme_adresse_livraison">Confirmer</button>
    </form>
  </div>
</div>

