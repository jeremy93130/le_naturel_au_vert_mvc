<?php
$mode = $mode ?? "insertion";
require "views/errors_form.html.php";
?>
<h1 class="text-white text-center"><?= $h1 ?></h1>
<form method="post" class="text-white w-50 m-auto">
    <div class="form-group mt-3">
        <label for="lastname">Nom <sup>*</sup></label>
        <input type="text" name="lastname" id="lastname" class="form-control" value="<?= $user->getLastname() ?>" <?= $mode == "suppression" ? "disabled" : "" ?> required>
    </div>

    <div class="form-group mt-3">
        <label for="firstname">Prénom <sup>*</sup></label>
        <input type="text" name="firstname" id="firstname" class="form-control" value="<?= $user->getFirstname() ?>" <?= $mode == "suppression" ? "disabled" : "" ?> required>
    </div>

    <div class="form-group mt-3">
        <label for="password">Mot de passe (6 caractères minimum)
            <sup>*</sup>
        </label>
        <input type="text" name="password" id="password" class="form-control" <?= $mode == "suppression" ? "disabled" : "" ?> required>
    </div>

    <div class="form-group mt-3">
        <label for="email">Email
            <sup>*</sup>
        </label>
        <input type="email" name="email" id="email" class="form-control" value="<?= $user->getEmail() ?>" <?= $mode == "suppression" ? "disabled" : "" ?> required>
    </div>

    <div class="form-group mt-3">
        <label for="phone"> Numéro de téléphone <sup>*</sup></label>
        <input type="text" name="phone" id="phone" class="form-control" value="<?= $user->getPhone() ?>" <?= $mode == "suppression" ? "disabled" : "" ?> required>
    </div>
    <div class="d-flex justify-content-between mt-3">
        <button type="submit" class="btn btn-primary" name="register">
            <?= $mode == "suppression" ? "Confirmer" : "Enregistrer" ?>
        </button>
        <a href="<?= addLink("home", 'index'); ?>" class="btn btn-danger">Annuler</a>
    </div>
</form>