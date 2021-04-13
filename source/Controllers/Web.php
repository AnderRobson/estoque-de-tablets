<?php

namespace Source\Controllers;

use CoffeeCode\Router\Router;
use League\Plates\Engine;
use Source\Model\SupplierModel;
use Source\Model\ProductModel;
use Source\Model\UserModel;

/**
 * Class Web
 * @package Source\Controllers
 */
class Web
{
    /** @var UserModel */
    protected UserModel $user;

    /** @var Engine */
    protected Engine $view;

    /** @var Router */
    protected Router $router;

    public function __construct($router)
    {
        $this->router = $router;
        $this->user = new UserModel($this->router);
        $this->view = Engine::create(PAGES_PATH, "php");
        $this->view->addData([
            "router" => $this->router,
            "user" => $this->user
        ]);
    }

    /**
     * Router name: Web:create
     */
    public function create(): void
    {
        echo $this->view->render("create");
    }

    /**
     * Router name: Web:login
     */
    public function login(): void
    {
        if ($this->user->validateLogged()) {
            $this->router->redirect('Web:read');
        }

        echo $this->view->render("login");
    }

    /**
     * Router name: Web:signin
     */
    public function logout(): void
    {
        $this->user->destruct();
        $this->router->redirect('Web:login');
    }

    /**
     * Router name: Web:signin
     */
    public function signin($data): void
    {
        if ($this->user->login($data['login'], $data['password'])) {
            flash("success", "Login realizado com sucesso");
            $this->router->redirect('Web:read');

            return;
        }

        flash("danger", "Erro ao realizar o login, verifique os dados informados");
        $this->router->redirect('Web:login');
    }

    /**
     * Router name: Web:read
     */
    public function read($data = []): void
    {
        $filter = false;
        if (! empty($_GET['search'])) {
            $filter = [
                "product.code = '{$_GET['search']}' OR supplier.name = '{$_GET['search']}'"
            ];
        }

        $product = new ProductModel();

        $products = $product->listAllInfoProduct($filter);

        echo $this->view->render("read", [
            'products' => $products
        ]);
    }

    /**
     * Router name: Web:update
     * @param $data
     */
    public function update($data): void
    {
        $product = new ProductModel();

        $productInfo = $product->findByIdProduct($data['id']);

        echo $this->view->render("update", [
            'product' => $productInfo
        ]);
    }

    /**
     * Router name: Web:delete
     * @param $data
     */
    public function delete($data): void
    {
        $product = new ProductModel();

        if ($product->delete($data['id'])) {
            flash("success", "Produto e Fornecedor deletado com sucesso");
        } else {
            flash("danger", "Erro ao deletar Produto e Fornecedor");
        }

        $this->router->redirect("Web:read");
    }

    /**
     * Router name: Web:createRegister
     * @param $data
     */
    public function createRegister($data): void
    {
        $supplier = new SupplierModel();
        $supplier->name = $data['name'];
        $supplier->phone = $data['phone'];
        $supplier->email = $data['email'];
        $supplier->zioCode = $data['zioCode'];
        $supplier->street = $data['street'];
        $supplier->number = $data['number'];
        $supplier->city = $data['city'];
        $supplier->state = $data['state'];
        $supplier = $supplier->save();

        $product = new ProductModel();
        $product->code = $data['code'];
        $product->brand = $data['brand'];
        $product->model = $data['model'];
        $product->color = $data['color'];
        $product->price = $data['price'];
        $product->manufacturingDate = $data['ManufacturingDate'];
        $product->dateRegistration = $data['dateRegistration'];
        $product->idSupplier = $supplier->id;
        $product = $product->save();

        if ($supplier->id == $product->idSupplier && $product->id) {
            flash("success", "Produto registrado com sucesso");
            $this->router->redirect("Web:read");

            return;
        }

        flash("danger", "Erro ao registrar o Produto");
        $this->router->redirect("Web:create");
    }

    /**
     * Router name: Web:updateRegister
     * @param $data
     */
    public function updateRegister($data): void
    {
        $product = new ProductModel();
        $product->code = $data['code'];
        $product->brand = $data['brand'];
        $product->model = $data['model'];
        $product->color = $data['color'];
        $product->price = $data['price'];
        $product->manufacturingDate = $data['ManufacturingDate'];
        $product->dateRegistration = $data['dateRegistration'];

        $product->id = $data['id'];
        $product = $product->save();

        $supplier = new SupplierModel();
        $supplier->name = $data['name'];
        $supplier->phone = $data['phone'];
        $supplier->email = $data['email'];
        $supplier->zioCode = $data['zioCode'];
        $supplier->street = $data['street'];
        $supplier->number = $data['number'];
        $supplier->city = $data['city'];
        $supplier->state = $data['state'];

        $supplier->id = $product->idSupplier;
        $supplier = $supplier->save();

        if ($supplier->id == $product->idSupplier && $product->id) {
            flash("success", "Produto atualizado com sucesso");
            $this->router->redirect("Web:read");

            return;
        }

        flash("danger", "Erro ao atualizar o Produto");
        $this->router->redirect("Web:update", ['id' => $data['id']]);
    }

    /**
     * Router name: Web:error
     * @param $errcode
     */
    public function error($errcode): void
    {
        $errcode = filter_var($errcode["errcode"], FILTER_VALIDATE_INT);

        echo $this->view->render("error", [
            'errcode' => $errcode
        ]);
    }
}