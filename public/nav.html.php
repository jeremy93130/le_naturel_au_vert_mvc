<nav class="navbar navbar-expand-lg <?= $css ?? "" ?>">
    <div class="container-fluid">
        <button class="navbar-toggler btn-hamburger" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse align-items-center" id="navbarSupportedContent">
            <h2 class="text-warning w-50">
                <a class="nav-link active titre-site" aria-current="page" href="<?= addLink('home', 'index'); ?>">Le Naturel Au Vert</a>
            </h2>
            <ul class="navbar-nav w-50 justify-content-end align-items-center">
                <?php if (!isset($_SESSION['user'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link text-warning" href="<?= addLink('user', 'login'); ?>">Connexion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-warning" href="<?= addLink('user', 'new'); ?>">Inscription</a>
                    </li>
                <?php } else { ?>
                        <div class="dropdown">
                            <?php if (isset($_SESSION['user'])) { ?>
                                    <button class="mainmenubtn">
                                        Bienvenu(e)
                                        <?= $_SESSION['user']->getPrenom(); ?>
                                    </button>
                            <?php } ?>
                            <div class="dropdown-child">
                                <ul class="dropdown-menu drop-nav bg-dark">
                                    <li>
                                        <a href="<?= addLink('user', 'infoUser') ?>" class="nav-link text-warning dropdown-item p-2">Informations personnelles</a>
                                    </li>
                                    <li>
                                        <a class="nav-link text-warning dropdown-item p-2" href="<?= addLink('historiqueCommandes', 'index') ?>">Historique des commandes</a>
                                    </li>
                                    <?php if (isset($_SESSION['user']) && $_SESSION['user']->getRole() === 'ROLE_ADMIN') { ?>
                                            <li>
                                                <a class="nav-link text-danger dropdown-item p-2" href="<?= addLink('admin/user','') ?>">Admin</a>
                                            </li>
                                    <?php } ?>
                                    <li>
                                        <a class="nav-link text-warning dropdown-item p-2" href="<?= addLink('user', 'logout') ?>">Se déconnecter</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                <?php } ?>
                <li class="list-unstyled me-5">
                    <a class="w-100" data-url="<?= addLink('panier', 'index'); ?>" id="url_panier">
                        <?php if ($_SERVER['REQUEST_URI'] != ROOT . 'commande/recapp' && $_SERVER['REQUEST_URI'] != ROOT . 'user/login' && $_SERVER['REQUEST_URI'] != ROOT . 'user/new') { ?>
                                <i class="fa-solid fa-cart-shopping nav-link text-warning" id="nav_panier">
                                    <span id="nb_articles">
                                        <?= $_SESSION['nombre'] ?? '' ?>
                                    </span>
                                </i>
                        <?php } ?>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

