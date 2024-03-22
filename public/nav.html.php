<div class="container-fluid">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="<?= addLink("home") ?>">
            <img src="<?= UPLOAD_LOGOS_IMG . "logo_watch.png" ?>" width="70" alt="watch-Logo" />
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?= addLink("home") ?>">Home</a>
                </li>
                <?php if( $userConnecte = Service\Session::getUserConnected() ): ?>
                <li class="nav-item">
                    <a class="nav-link"
                        href="<?= addLink("user", "show", $userConnecte->getId()) ?>"><?= $userConnecte->getSurname() ?></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?= addLink("user", "logout") ?>">
                        <i class="fa fa-sign-out"></i>
                    </a>
                </li>

                <?php if( Service\Session::isadmin() ): ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Produits
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?= addLink('admin/product', 'list') ?>">Liste</a></li>
                        <li><a class="dropdown-item" href="<?= addLink('admin/product', 'new') ?>">Ajouter</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Utilisateurs
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?= addLink('admin/user', 'list') ?>">Liste</a></li>
                        <li><a class="dropdown-item" href="<?= addLink('admin/user', 'new') ?>">Ajouter</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        categories
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?= addLink('admin/category', 'list') ?>">Liste</a></li>
                        <li><a class="dropdown-item" href="<?= addLink('admin/category', 'new') ?>">Ajouter</a></li>
                    </ul>
                </li>
                <?php endif; ?>

                <?php else: ?>
                <li class="nav-item active">
                    <a class="nav-link" href="<?= addLink("user", "login") ?>">
                        <i class="fa fa-sign-in"></i>
                    </a>
                </li>
                <?php endif ?>

                <li class="nav-item active">
                    <a class="nav-link" href="<?= addLink("cart", "show") ?>">
                        <i class="fa fa-shopping-cart"></i>

                        <div id="nombre"><?= $_SESSION["nombre"] ?? ''; ?></div>
                    </a>
                </li>
            </ul>


            <form class="d-flex" role="search" id="formSearch" action="<?= addLink("search", "searchTag");  ?>">
                <input class="form-control me-2" id="search" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </nav>
</div>