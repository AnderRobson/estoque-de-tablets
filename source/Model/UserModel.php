<?php

namespace Source\Model;

use CoffeeCode\Router\Router;
use Exception;
use Source\Repository\UserRepository;

class UserModel
{
    /** @var Router */
    private $router;

    /** @var UserRepository */
    private $UserRepository;

    private $id;

    private $name;

    private $login;

    private $password;

    /** @var bool */
    private bool $islogged;

    const PUBLIC_ROUTES = [
        '/',
        '/signin'
    ];

    /**
     * User constructor.
     */
    public function __construct($router = null)
    {
        if ($router) {
            $this->router = $router;
            $this->UserRepository = new UserRepository();

            $userId = ! empty($_SESSION['user']) ?
                filter_var($_SESSION['user'], FILTER_VALIDATE_INT)
                : null;

            $user = ! empty($userId) ?
                $this->UserRepository->findFirst([
                    'where' => [
                        'id' => $userId
                    ]
                ]) : false;

            if ($user) {
                $this->id = $user->id;
                $this->name = $user->name;
                $this->login = $user->login;
            }

            $this->islogged = (bool) $user;

            $this->validatePermission();
        }
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Responsavel por limpar a sessão
     */
    public function destruct(): void
    {
        unset($_SESSION["user"]);
        $this->islogged = false;
    }

    private function validatePermission()
    {
        $route = ! empty($_GET['route']) ? $_GET['route'] : '/';

        if (! in_array($route, self::PUBLIC_ROUTES) && ! $this->validateLogged()) {
            $this->router->redirect('Web:login');
        }
    }

    public function login(string $login, string $password): bool
    {
        if (! empty($_SESSION['user'])) {
            return $this->validateLogged();
        }

        $login = filter_var($login, FILTER_DEFAULT);
        $password = filter_var($password, FILTER_DEFAULT);

        $user = $this->UserRepository->findFirst([
            'where' => [
                'login' => $login
            ]
        ]);

        if (! $user || ! password_verify($password, $user->password)) {
            $this->islogged = false;
            return $this->islogged;
        }

        $_SESSION['user'] = $user->id;
        $this->id = $user->id;
        $this->name = $user->name;
        $this->login = $user->login;

        $this->islogged = (bool) $this->id;

        return $this->islogged;
    }

    /**
     * Responsavel por validar se tem um usuário logado
     *
     * @return bool
     */
    public function validateLogged(): bool
    {
        if (! $this->islogged) {
            $this->destruct();
        }

        return $this->islogged;
    }
}
