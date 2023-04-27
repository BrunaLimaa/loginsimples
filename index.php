<?php

ob_start();
session_start();

require __DIR__ . "/vendor/autoload.php";
use CoffeeCode\Router\Router;

$route = new Router(CONF_URL_BASE, ":");
//$route = new Router('localhost/acme-manha', ":"); // Route para localhost

/**
 * Web Routes
 */

$route->namespace("Source\App");
$route->get("/","Web:home");
$route->post("/login","Web:login");
$route->get("/entrar","Web:register");
$route->post("/entrar","Web:register");

/**
 * App Routs
 */

$route->group("/app"); // agrupa em /app
$route->get("/","App:home");
$route->get("/logout","App:logout");



$route->group(null); // desagrupo do /admin

/*
 * Erros Routes
 */

$route->group("error")->namespace("Source\App");
$route->get("/{errcode}", "Web:error");

$route->dispatch();

/*
 * Error Redirect
 */

if ($route->error()) {
    $route->redirect("/error/{$route->error()}");
}

ob_end_flush();