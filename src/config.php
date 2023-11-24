<?php

use function DI\create;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

return [
    'connection'=>create(\Opis\Database\Connection::class)->constructor(
        'mysql:host=localhost;dbname=1135-db',
        'admin',
        '123'
    ),'Db'=>create(\Opis\Database\Database::class)->constructor(\DI\get('connection')),
    'Loader'=>create(Twig\Loader::class)->constructor('./template/twig'),
    'Twig'=>create(Environment::class)->constructor(\DI\get('Loader',[])),
    'FrontView'=> create(\App\View::class)->constructor(\DI\get('Twig')),

    \App\FrontEndController::class=>create(\App\FrontEndController::class)->constructor(\App\Model\ArticleModel::class),
    (\DI\get('FrontView')),
    \App\BackEndController::class=>create(\App\BackEndController::class)->constructor(\DI\get('FrontView')),
    \App\BackEndView::class=>create(\App\BackEndView::class)->constructor(\DI\get('FrontView'))
];