<?php


namespace App\Core;


abstract class CoreController implements ControllerInterface
{

    private ModelInterface $Model;

    private ViewInterface $View;

    /**
     * TodoController constructor.
     */
    public function __construct(ModelInterface $Model,ViewInterface $View)
    {
        $this->Model = $Model;
        $this->View = $View;
    }

}