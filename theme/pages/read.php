<?php $v->layout("_theme", ["title" => "Listagem"]); ?>
<div class="container mt-5">
    <?= flash(); ?>
    <div class="row">
        <table class="table table-dark">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Código</th>
                <th scope="col">Marca</th>
                <th scope="col">Modelo</th>
                <th scope="col">Cor</th>
                <th scope="col">Preço</th>
                <th scope="col">Data de fabricação</th>
                <th scope="col">Data de cadastro</th>
                <th scope="col">Nome Forn</th>
                <th scope="col">Telefone Forn</th>
                <th scope="col">Email Forn</th>
                <th scope="col">Rua Forn</th>
                <th scope="col">Número Forn</th>
                <th scope="col">Cidade Forn</th>
                <th scope="col">Estado Forn</th>
                <th scope="col">CEP Forn</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
                <?php if (! empty($products)): ?>
                    <?php foreach ($products as $productLine): ?>
                        <tr>
                            <th scope="row"><?= $productLine->product->code; ?></th>
                            <td><?= $productLine->product->brand; ?></td>
                            <td><?= $productLine->product->model; ?></td>
                            <td><?= $productLine->product->color; ?></td>
                            <td><?= currencyFormatter($productLine->product->price); ?></td>
                            <td><?= $productLine->product->manufacturingDate; ?></td>
                            <td><?= $productLine->product->dateRegistration; ?></td>

                            <td><?= $productLine->supplier->name; ?></td>
                            <td><?= $productLine->supplier->phone; ?></td>
                            <td><?= $productLine->supplier->email; ?></td>
                            <td><?= $productLine->supplier->street; ?></td>
                            <td><?= $productLine->supplier->number; ?></td>
                            <td><?= $productLine->supplier->city; ?></td>
                            <td><?= $productLine->supplier->state; ?></td>
                            <td><?= $productLine->supplier->zioCode; ?></td>
                            <td>
                                <a href="<?= $router->route("Web:delete", ['id' => $productLine->product->id]); ?>">
                                    <i data-feather="trash-2" title="Excluir" style="color: red;"></i>
                                </a>
                                <a href="<?= $router->route("Web:update", ['id' => $productLine->product->id]); ?>">
                                    <i data-feather="edit" title="Excluir" style="color: red;"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
