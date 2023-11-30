<?php

declare(strict_types=1);


namespace App;

use App\Helper as h;
use App\Core\Auth;

class BackEndController
{
    private Model $model;
    private BackEndView $view;
    use Auth;

    public function __construct()
    {
        $this->model = new Model();
        $this->view = new BackEndView();
        if (!$this->checkAuth()) {
            $this->auth();
            exit;
        }
    }

    public function auth(): void
    {
        if (!isset($_POST['btnLogin'])) {
            $this->showLoginForm();
            exit;
        } else {
            if ($this->checkLogin($_POST['username'], $_POST['password'])) {
                $this->signIn('admin', 1);
                $this->setMessage('Привет $username');
            }
            h::goUrl('/admin');
        }
    }

    public function checkLogin(string $login, string $password): bool
    {
        if ($login == 'admin' and $password == '123') {
            return true;
        } else {
            return false;
        }
    }

    public function index(): void
    {
        $title = 'Список статей';
        $this->view->showIndex($title);
    }

    public function showLoginForm(): void
    {
        $this->view->showLoginForm();
    }

    public function logout(): void
    {
        $this->signOut();
        h::goUrl('/admin');
    }

    public function setMessage(
        $message,
        $title = '',
        $color = 'green',
        $position = 'topRight'
    ): void
    {
        $_SESSION['message'] = [
            'color'    => $color,
            'title'    => $title,
            'message'  => $message,
            'position' => $position,
        ];
    }

    public function articlesList(): void
    {
        $title = 'Список статей';
        $articles = $this->model->getArticles();
        $this->view->showArticlesList($title, $articles);
    }

    public function showArticleCreateForm(): void
    {
        $title = 'Добавление статьи';
        $article = [];
        $action = '/admin/articles/create';
        $this->view->showArticleForm($title, $article, $action);
    }

    public function showArticleEditForm($id): void
    {
        $title = 'Редактирование статьи';
        $article = $this->model->getArticlesById((int)$id);
        $action = '/admin/articles/update';
        $this->view->showArticleForm($title, $article, $action);
    }

    public function articleDelete($id): void
    {
        if ($this->model->articleDelete((int)$id)) {
            h::goUrl('/admin/articles');
            //return true;
        }
        //return false;
        h::goUrl('/admin/articles');
    }

    public function articleCreate(): void
    {
        $articleFields = $this->checkFields($_POST, $this->model->articleFields());
        $articles = $this->model->getArticles();
        $lastId = end($articles)['id'];
        $id = $lastId + 1;
        $articles[$id] = [
            'id' => $id,
            'title' => $articleFields['title'],
            'image' => $articleFields['image'],
            'content' => $articleFields['content']
        ];
        $this->model->saveArticles($articles);
        h::goUrl('/admin/articles');
    }

    public function checkFields(array $target, array $fields, bool $html = true): array
    {
        $checkedFields = [];
        foreach ($fields as $name) {
            if (isset($target[$name]) && $html == false) {
                $checkedFields[$name] = trim($target[$name]);
            } elseif (isset($target[$name]) && $html == true) {
                $checkedFields[$name] = htmlspecialchars(string: trim($target[$name]));
            }
        }
        return $checkedFields;
    }

    public function articleUpdate(): void
    {
        $articleItem = $this->checkFields($_POST, $this->model->articleFields());
        $articles = $this->model->getArticles();
        if (isset($articles[$articleItem['id']])) {
            $articles[$articleItem['id']] = [
                'id' => $articleItem['id'],
                'title' => $articleItem['title'],
                'image' => $articleItem['image'],
                'content' => $articleItem['content']
            ];
            $this->model->saveArticles($articles);
            //return true;
        }
        h::goUrl('/admin/articles');
    }
}