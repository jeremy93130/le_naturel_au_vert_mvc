<?php
require "views/errors_form.html.php";
?>
<div class="container-height d-flex">
    <form method="post" class="form-login text-warning">
        <h1><?= $h1 ?></h1>
        <?php if (isset($_SESSION['message_connexion'])) { ?>
            <div class="alert alert-danger text-center">
                <p><?= $_SESSION['message_connexion']; ?></p>
                <p>Pas encore inscrit ?
                    <a href="<?= addLink('user', 'register'); ?>">par ici</a>
                </p>
            </div>
        <?php }
        unset($_SESSION['message_connexion']); ?>
        <div class="form-group">
            <label for="email">Email
                <sup>*</sup>
            </label>
            <input type="text" name="email" id="email" class="form-control" value="<?= isset($_COOKIE['email_connexion']) ? $_COOKIE['email_connexion'] : "" ?>">
        </div>

        <div class="form-group">
            <label for="password">Mot de passe
                <sup>*</sup>
            </label>
            <input type="password" name="password" id="password" class="form-control" value="<?= isset($_COOKIE['password_connexion']) ? $_COOKIE['password_connexion'] : "" ?>">
        </div>

        <div class="d-flex align-items-center">
            <label for="remember">Enregistrer les informations pour la prochaine connexion</label>
            <input type="checkbox" name="remember" style="width: 40px; height: 20px">
        </div>

        <div class="form-group btn-center">
            <button type="submit" class="btn btn-primary" name="login">
                Connexion
            </button>
        </div>
    </form>
</div>