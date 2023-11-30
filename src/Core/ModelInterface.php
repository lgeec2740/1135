<?php


namespace App\Core;


interface ModelInterface
{

    public function all():mixed;

    public function find(int $id):mixed;

    public function count():int;

}