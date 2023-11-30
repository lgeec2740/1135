<?php


namespace App\Core;


abstract class CoreView implements ViewInterface
{
    /**
     * @var \Twig\Loader\FilesystemLoader
     */
    public $loader;
    /**
     * @var \Twig\Environment
     */
    public $twig;

    /**
     * CoreView constructor.
     * @param string $path
     */
    public function __construct($path = 'template/')
    {
        $this->loader = new \Twig\Loader\FilesystemLoader($path);
        $this->twig = new \Twig\Environment($this->loader, [

        ]);
    }
}