<?php


namespace Todo;


/**
 * Class TodoView
 * @package Todo
 */
class TodoView
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

    /**
     * @param $work_list
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function showIndexTwig($work_list)
    {
        echo $this->twig->render(
            'index.twig',
            [
                'title' => 'Добавит новое задание',
                'action' => 'add',
                'work_list'=>$work_list
            ]);
    }

    /**
     * @param $work
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function showEditTwig($work)
    {

        echo $this->twig->render(
            'edit.twig',
            [
                'title' => 'Редактирование задания',
                'action' => '/update',
                'work'=>$work
            ]);
    }







}