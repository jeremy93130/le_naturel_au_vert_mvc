<div class="container-height text-warning">
    <h1 class="text-center">Ajout d'utilisateur</h1>
    <form method="post" class="text-warning w-50 m-auto">
        <div class="form-group mt-3">
            <label for="lastname">Nom
                <sup>*</sup>
            </label>
            <input type="text" name="nom" id="lastname"class="form-control" required>
        </div>

        <div class="form-group mt-3">
            <label for="firstname">Prénom
                <sup>*</sup>
            </label>
            <input type="text" name="prenom" id="firstname" class="form-control" required>
        </div>

        <div class="form-group mt-3">
            <label for="password_inscription">Mot de passe (6 caractères minimum)
                <sup>*</sup>
            </label>
            <div class="mdp_show">
                <input type="password" name="password" id="password_inscription" class="form-control"required>
                <i class="fa-regular fa-eye" id="oeil_mdp"></i>
            </div>
        </div>

        <div class="form-group mt-3">
            <label for="email">Email
                <sup>*</sup>
            </label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>

        <div class="form-group mt-3">
            <label for="birthday">Date de naissance
                <sup>*</sup>
            </label>
            <input type="date" name="birthday" id="birthday" class="form-control" required>
        </div>

        <div class="form-group mt-3">
            <label for="phone">
                Numéro de téléphone
                <sup>*</sup>
            </label>
            <input type="text" name="telephone" id="phone" class="form-control" required>
        </div>
        <div class="d-flex justify-content-between mt-3">
            <button type="submit" class="btn btn-primary" name="register">S'inscrire</button>
            <a href="<?= addLink("home", 'index'); ?>" class="btn btn-danger">Annuler</a>
        </div>
    </form>
</div>