<?php
declare(strict_types=1);
namespace App;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\FilesystemLoader;

class View{
    public FilesystemLoader $loader;
    public Environment $twig;
    public function __construct(){
        $this->loader = new FilesystemLoader('/');
        $this->twig = new Environment($this->loader, []);
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function showArticleList($articles): void
    {
        echo $this->twig->render('blog-list.twig', ['articles' =>$articles]);
    }

    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    public function showSingleArticle($article): void
    {
        echo $this->twig->render('blog-single.twig', ['article' =>$article]);
    }
}
