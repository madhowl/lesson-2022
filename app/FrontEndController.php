<?php


namespace App;


use App\Core\ModelInterface;
use App\Core\ViewInterface;

class FrontEndController extends Core\CoreController
{
    private ModelInterface $Model;

    private ViewInterface $View;

    public function __construct(ModelInterface $Model, ViewInterface $View)
    {
        parent::__construct($Model, $View);
    }

    public function test()
    {
        dd($this->View);
    }
}