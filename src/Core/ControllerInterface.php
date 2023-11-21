<?php


namespace App\Core;


interface ControllerInterface
{


    public function __construct(ModelInterface $model,ViewInterface $view);
}