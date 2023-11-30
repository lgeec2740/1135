<?php
namespace App;
use Opis\Database\Database;
use Opis\Database\Connection;

class Db{
    public function select(){
        $connection = new Connection(
            'mysql:host=localhost;dbname=1135-db',
            'dima05',
            'Machtakov05'
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
    public function update(){
        $connection = new Connection(
            'mysql:host=localhost;dbname=1135-db',
            'dima05',
            'Machtakov05'
        );
        $db = new Database($connection);

        $result = $db->update('articles')
            ->where('id')->is(2014)
            ->set(array(
                'friends_no' => function($expr){
                    $expr->column('friends_no')->{'+'}->value(1);
                }
            ));
    }
    public function delete(){
        $connection = new Connection(
            'mysql:host=localhost;dbname=1135-db',
            'dima05',
            'Machtakov05'
        );
        $db = new Database($connection);

        $result = $db->from('articles')
            ->where('article')->isNull()
            ->delete();
    }


}