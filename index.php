<?php
declare(strict_types=1);
require_once 'vendor/autoload.php';

use NoahBuscher\Macaw\Macaw;
use Tracy\Debugger;
use FastRoute\simpleDispatcher;
use FastRoute\RouteCollector;

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

Debugger::enable();

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', 'App\FrontEndController@articleList');
    // {id} must be a number (\d+)
    $r->addRoute('GET', 'article/(:num)', 'App\FrontEndController@singleArticle');
    // The /{title} suffix is optional
    $r->addRoute('GET', '/admin/articles', 'App\BackEndController@articlesList');
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        // ... call $handler with $vars
        break;
}

Macaw::get('/', 'App\FrontEndController@articleList');
Macaw::get('article/(:num)', 'App\FrontEndController@singleArticle');

// admin

Macaw::get('/admin', 'App\BackEndController@index');
Macaw::get('/admin/login', 'App\BackEndController@login');
Macaw::post('/admin/login', 'App\BackEndController@auth');
Macaw::get('/admin/logout', 'App\BackEndController@logout');
// articles CRUD
Macaw::get('/admin/articles', 'App\BackEndController@articlesList');
Macaw::get('/admin/article/create', 'App\BackEndController@showArticleCreateForm');
Macaw::get('/admin/article/edit/(:num)', 'App\BackEndController@showArticleEditForm');
Macaw::get('/admin/article/delete/(:num)', 'App\BackEndController@articleDelete');
Macaw::post('/admin/article/update/', 'App\BackEndController@articleUpdate');
Macaw::post('/admin/article/create', 'App\BackEndController@articleCreate');

Macaw::dispatch();




