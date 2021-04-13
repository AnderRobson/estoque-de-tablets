<?php $v->layout("_theme", ["title" => "Atualizar"]); ?>
<div class="container mt-5">
    <form action="<?= $router->route("Web:updateRegister", ['id' => $product->product->id]); ?>" method="post">
        <h2 class="text-center"><strong>Editar Tablet</strong></h2>
        <div class="row mt-2">
            <div class="col-sm">
                <label for="code">Código único:</label>
                <input type="text" class="form-control" name="code" value="<?= $product->product->code; ?>" id="code" required />
            </div>
            <div class="col-sm">
                <label for="brand">Marca:</label>
                <input type="text" class="form-control" name="brand" value="<?= $product->product->brand; ?>" id="brand" required />
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-sm">
                <label for="model">Modelo:</label>
                <input type="text" class="form-control" name="model" value="<?= $product->product->model; ?>" id="model" required />
            </div>
            <div class="col-sm">
                <label for="color">Cor:</label>
                <input type="text" class="form-control" name="color" value="<?= $product->product->color; ?>" id="color" required />
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-sm">
                <label for="price">Preço:</label>
                <input type="number" min="0.00" max="10000.00" step="0.01" class="form-control" name="price" value="<?= $product->product->price; ?>" id="price" required />
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-sm">
                <label for="ManufacturingDate">Data de fabricação:</label>
                <input type="date" class="form-control" name="ManufacturingDate" value="<?= $product->product->manufacturingDate; ?>" id="ManufacturingDate" required />
            </div>
            <div class="col-sm">
                <label for="dateRegistration">Data de cadastro no sistema:</label>
                <input type="date" class="form-control" name="dateRegistration" value="<?= $product->product->dateRegistration; ?>" id="dateRegistration" required />
            </div>
        </div>
        <h2 class="text-center mt-5"><strong>Editar Fornecedor</strong></h2>
        <div class="row mt-2">
            <div class="col-sm">
                <label for="name">Nome:</label>
                <input type="text" class="form-control" name="name" value="<?= $product->supplier->name; ?>" id="name" required />
            </div>
            <div class="col-sm">
                <label for="phone">telefone:</label>
                <input type="text" class="form-control" name="phone" value="<?= $product->supplier->phone; ?>" id="phone" required />
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-sm">
                <label for="email">E-mail:</label>
                <input type="email" class="form-control" name="email" value="<?= $product->supplier->email; ?>" id="email" required />
            </div>
            <div class="col-sm">
                <label for="zioCode">cep:</label>
                <input type="text" class="form-control" name="zioCode" value="<?= $product->supplier->zioCode; ?>" id="zioCode" required />
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-sm">
                <label for="street">rua:</label>
                <input type="text" class="form-control" name="street" value="<?= $product->supplier->street; ?>" id="street" required />
            </div>
            <div class="col-sm">
                <label for="number">número:</label>
                <input type="number" class="form-control" name="number" value="<?= $product->supplier->number; ?>" id="number" required />
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-sm">
                <label for="city">cidade:</label>
                <input type="text" class="form-control" name="city" value="<?= $product->supplier->city; ?>" id="city" required />
            </div>
            <div class="col-sm">
                <label for="state">estado:</label>
                <input type="text" class="form-control" name="state" value="<?= $product->supplier->state; ?>" id="state" required />
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-sm">
                <input type="submit" class="form-control" name="submit" title="Salvar" />
            </div>
        </div>
    </form>
</div>
