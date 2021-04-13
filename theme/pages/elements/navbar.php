<header>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark">
        <div class="container">
            <a class="navbar-brand" href="<?= $router->route("Web:read"); ?>" style="margin-left: 20px;">CRUD</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto" style="margin-left: 20px;">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $router->route("Web:read"); ?>">Listagem</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $router->route("Web:create"); ?>">Cadastro de Produtos</a>
                    </li>
                </ul>
                <ul class="navbar-nav px-3 ml-2">
                    <?php if ($user->validateLogged()): ?>
                        <li class="nav-item dropdown">
                            <a id="navDrop" class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" >
                                <?= $user->getName();?>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" >
                                <a class="dropdown-item" href="<?= $router->route("Web:logout"); ?>">Sair</a>
                            </div>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $router->route("Web:login"); ?>">Login</a>
                        </li>
                    <?php endif; ?>
                </ul>
                <form action="<?= $router->route("Web:read"); ?>" method="get" class="form-inline">
                    <input class="form-control form-control-dark ml-4 mr-2" type="search" name="search" placeholder="Buscar" aria-label="Search">
                    <button class="btn btn-dark" type="submit">Ok</button>
                </form>
            </div>
        </div>
    </nav>
</header>