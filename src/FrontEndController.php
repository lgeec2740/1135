<?php
namespace App;
use App\View;
use App\Model;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class FrontEndController
{
    private Model\ArticleModel $articleModel;
    private \App\View $view;

    public function  __construct(Model\ArticleModel $articleModel,\App\View $view)
    {
        $this->articleModel = $articleModel;
        $this->view = $view;
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function articleList(): void
    {
        $articles = $this->articleModel->all();
        $this->view->showArticleList($articles);
    }

    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    public function singleArticle($id): void
    {
        $article = $this->articleModel->find((int)$id);
        $this->view->showSingleArticle($article);
    }
}

