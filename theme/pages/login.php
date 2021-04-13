<?php $v->layout("_theme", ["title" => "Login"]); ?>
<div class="container mt-5">
    <?= flash() ?>
    <form action="<?= $router->route("Web:signin"); ?>" method="post" class="form-signin mx-auto col-md-4">
        <div class="row mt-5">
            <h1 class="h3 mb-3 font-weight-normal text-center">Login</h1>
            <label for="login" class="sr-only">Login</label>
            <input type="text" id="login" name="login" class="form-control" placeholder="Login" required="" autofocus="">
        </div>

        <div class="row mt-2">
            <label for="password" class="sr-only">Senha</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Senha" required="">
        </div>

        <div class="row mt-5">
            <button class="btn btn-lg btn-primary btn-block" type="submit">Logar</button>
        </div>
    </form>
</div>


