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

    public function  __construct($model,$view)
    {
        $this->model = $model;
        $this->view = $view;
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
        $this->view->showSingleArticle($article);
    }
}

