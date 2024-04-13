<?php
$mode = $mode ?? "insertion";
require "views/errors_form.html.php";
?>
<div class="container-height">
    <h1 class="text-warning text-center"><?= $h1 ?></h1>
    <form method="post" class="text-warning w-50 m-auto">
        <div class="form-group mt-3">
            <label for="lastname">Nom <sup>*</sup></label>
            <input type="text" name="nom" id="lastname" value="<?= $userInvalid ? $userInvalid->getNom() : null ?>" class="form-control" <?= $mode == "suppression" ? "disabled" : "" ?> required>
        </div>

        <div class="form-group mt-3">
            <label for="firstname">Prénom <sup>*</sup></label>
            <input type="text" name="prenom" id="firstname" value="<?= $userInvalid ? $userInvalid->getPrenom() : null ?>" class="form-control" <?= $mode == "suppression" ? "disabled" : "" ?> required>
        </div>

        <div class="form-group mt-3">
            <label for="password_inscription">Mot de passe (6 caractères minimum)
                <sup>*</sup>
            </label>
            <div class="mdp_show">
                <input type="password" name="password" id="password_inscription" class="form-control" value="<?= $userInvalid ? $_SESSION['password_inscription'] : "" ?>" <?= $mode == "suppression" ? "disabled" : "" ?> required>
                <i class="fa-regular fa-eye" id="oeil_mdp"></i>
            </div>
        </div>

        <div class="form-group mt-3">
            <label for="email">Email
                <sup>*</sup>
            </label>
            <input type="email" name="email" id="email" class="form-control" <?= $mode == "suppression" ? "disabled" : "" ?> required>
        </div>

        <div class="form-group mt-3">
            <label for="phone"> Numéro de téléphone <sup>*</sup></label>
            <input type="text" name="telephone" id="phone" value="<?= $userInvalid ? $userInvalid->getPhone() : null ?>" class="form-control" <?= $mode == "suppression" ? "disabled" : "" ?> required>
        </div>
        <div class="d-flex justify-content-between mt-3">
            <button type="submit" class="btn btn-primary" name="register">
                <?= $mode == "suppression" ? "Confirmer" : "Enregistrer" ?>
            </button>
            <a href="<?= addLink("home", 'index'); ?>" class="btn btn-danger">Annuler</a>
        </div>
    </form>
</div>