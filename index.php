<?php
ob_start();
session_start();

require __DIR__ . "/vendor/autoload.php";

use CoffeeCode\Router\Router;

$router = new Router("http://localhost/qi");


$router->namespace("Source\Controllers");

$router->get("/", "Web:login", "Web:login");
$router->get("/logout", "Web:logout", "Web:logout");
$router->get("/read", "Web:read", "Web:read");
$router->get("/create", "Web:create", "Web:create");
$router->get("/update/{id}", "Web:update", "Web:update");
$router->get("/delete/{id}", "Web:delete", "Web:delete");
$router->post("/signin", "Web:signin", "Web:signin");
$router->post("/create", "Web:createRegister", "Web:createRegister");
$router->post("/update/{id}", "Web:updateRegister", "Web:updateRegister");


$router->get("/ooops/{errcode}", "Web:error", "Web:error");

$router->dispatch();

if ($router->error()) {
    $router->redirect("Web:error", [
        'errcode' => $router->error()
    ]);
}
