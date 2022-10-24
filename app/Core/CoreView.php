<?php


namespace App\Core;


abstract class CoreView
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
     * TodoView constructor.
     * @param string $path
     */
    public function __construct($path = 'templates/')
    {
        $this->loader = new \Twig\Loader\FilesystemLoader('templates/');
        $this->twig = new \Twig\Environment($this->loader, [

        ]);
    }
}