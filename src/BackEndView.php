<?php

declare(strict_types=1);


namespace App;


use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class BackEndView
{
    public FilesystemLoader $loader;
    public Environment $twig;

    public function __construct()
    {
        $this->loader = new FilesystemLoader('template/backend');
        $this->twig = new Environment($this->loader, []);
    }

    public function index(): void
    {
        echo $this->twig->render('dashboard.twig');
    }

    public function showLoginForm(): void
    {
        echo $this->twig->render('login.twig');
    }

    public function showIndex(string $title): void
    {
        echo $this->twig->render('dashboard.twig', ['title' => $title,]);
    }

    public function showArticlesList(string $title, array $articles): void
    {
        echo $this->twig->render(
            'articles-list.twig',
            [
                'title' => $title,
                'articles' => $articles
            ]
        );
    }

    public function showArticleForm($title, $article, $action): void
    {
        echo $this->twig->render(
            'article-form.twig',
            [
                'title' => $title,
                'article' => $article,
                'action' => $action
            ]
        );
    }

}