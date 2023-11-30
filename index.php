<?php
declare(strict_types=1);
session_start();
$container = require __DIR__ . '/src/bootstrap.php';


use Tracy\Debugger;
use FastRoute\RouteCollector;

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', ['App\FrontEndController','articleList']);
    $r->addRoute('GET', '/article/{id}', ['App\FrontEndController','singleArticle']);

    $r->addRoute('GET', '/admin', ['App\BackEndController','index']);
    $r->addRoute('POST', '/admin/login', ['App\BackEndController','login']);
    $r->addRoute('GET', '/admin/login', ['App\BackEndController','auth']);
    $r->addRoute('GET', '/admin/logout', ['App\BackEndController','logout']);

    $r->addRoute('GET', '/admin/articles', ['App\BackEndController','articlesList']);
    $r->addRoute('GET', '/admin/articles/create', ['App\BackEndController','showArticleCreateForm']);
    $r->addRoute('GET', '/admin/articles/edit/{id}', ['App\BackEndController','showArticleEditForm']);
    $r->addRoute('GET', '/admin/articles/delete/{id}', ['App\BackEndController','articleDelete']);
    $r->addRoute('POST', '/admin/articles/update', ['App\BackEndController','articleUpdate']);
    $r->addRoute('POST', '/admin/articles/create', ['App\BackEndController','articleCreate']);
});

$route = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

switch ($route[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        echo '404 Not Found';
        break;

    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        echo '405 Method Not Allowed';
        break;

    case FastRoute\Dispatcher::FOUND:
        $controller = $route[1];
        $parameters = $route[2];

        // We could do $container->get($controller) but $container->call()
        // does that automatically
        $container->call($controller, $parameters);
        break;
}




