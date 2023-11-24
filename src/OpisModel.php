<?php
namespace App;
use Opis\Database\Database;
use Opis\Database\Connection;

class Db{
    public function select(){
        $connection = new Connection(
            'mysql:host=localhost;dbname=1135-db',
            'admin',
            '123'
        );
        $db = new Database($connection);

        $result = $db->from('articles')
            ->select()
            ->fetchObject()
            ->all();

        foreach ($result as $user){
            echo $user['title'];
        }
    }
}