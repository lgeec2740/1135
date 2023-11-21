<?php
namespace App;
use App\View;
use App\Model;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class FrontEndController
{
    private \App\Model $model;
    private \App\View $view;

    public function  __construct()
    {
        $this->model = new \App\Model();
        $this->view = new \App\View();
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function articleList(): void
    {
        $articles = $this->model->getArticles();
        $this->view->showArticleList($articles);
    }

    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    public function singleArticle($id): void
    {
        $article = $this->model->getArticlesById((int)$id);
        echo '<pre>';
        var_dump($article);
        $this->view->showSingleArticle($article);
    }
}

