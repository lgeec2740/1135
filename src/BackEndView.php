<?php

declare(strict_types=1);


namespace App;


class BackEndView
{
    public $loader;
    public $twig;

    public function __construct()
    {
        $this->loader = new \Twig\Loader\FilesystemLoader('template/backend');
        $this->twig = new \Twig\Environment($this->loader, []);
    }

    public function index()
    {
        echo $this->twig->render('dashboard.twig');
    }

    public function showLoginForm()
    {
        echo $this->twig->render('login.twig');
    }

    public function showIndex(string $title)
    {
        echo $this->twig->render('dashboard.twig', ['title' => $title,]);
    }

    public function showArticlesList(string $title, array $articles)
    {
        echo $this->twig->render(
            'articles-list.twig',
            [
                'title' => $title,
                'articles' => $articles
            ]
        );
    }

    public function showSingleArticle($article)
    {
        echo $this->twig->render('blog-single.twig', ['article' => $article]);
    }

    public function showArticleForm($title, $article, $action)
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