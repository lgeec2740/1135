<?php

use App\BackEndController;
use function DI\create;
use function DI\get;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use \App\Model\ArticleModel;
use \App\FrontEndController;

return [
    'connection' => create(\Opis\Database\Connection::class)->constructor(
        $_ENV['DB_DSN'],
        $_ENV['DB_USERNAME'],
        $_ENV['DB_PASSWORD']
    ),
    'Db' => create(\Opis\Database\Database::class)
        ->constructor(
            get('connection')
        ),
    ArticleModel::class => create(ArticleModel::class)
        ->constructor(
            get('Db')
        ),
    'FrontLoader' => create(FilesystemLoader::class)->constructor('./template/twig'),
    'FrontTwig' => create(Environment::class)->constructor(get('FrontLoader', [])),
    'FrontView' => create(\App\View::class)->constructor(get('FrontTwig')),
    'BackLoader' => create(FilesystemLoader::class)->constructor('./template/backend'),
    'BackTwig' => create(Environment::class)->constructor(get('BackLoader', [])),
    'BackView' => create(\App\View::class)->constructor(get('BackTwig')),
    FrontEndController::class => create(FrontEndController::class)
        ->constructor(
            get(ArticleModel::class),
            get('FrontView')
        ),
    BackEndController::class => create(BackEndController::class)
        ->constructor(
            get(ArticleModel::class),
            get('BackView')
        ),
];