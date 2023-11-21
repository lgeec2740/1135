<?php
namespace App;
class Model{
    public function getArticles():array
    {
        return json_decode(file_get_contents('db/articles.json'), true);
    }
    public function getArticlesById(int $id): array {
        $articleList = $this->getArticles();
        $currentArticle = [];
        foreach ($articleList as $ar){
            if(array_key_exists($id, $articleList))
            {
                $currentArticle = $articleList[$id];
            }
        }
        return $currentArticle;
    }

    function articleFields():array
    {
        return [
            'id' ,
            'title' ,
            'image' ,
            'content'
        ];
    }

    public function saveArticles(array $articles) : bool{
        file_put_contents('db/articles.json', json_encode($articles));
        return true;
    }

    function articleDelete(int $id) : bool{
        $articles = $this->getArticles();
        if(isset($articles[$id])){
            unset($articles[$id]);
            $this->saveArticles($articles);
            return true;
        }
        return false;
    }
}
