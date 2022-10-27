<?php


namespace App;


use App\Core\CoreModel;

class FrontEndController
{
    private  $Model;

    private  $View;

    public function __construct( $Model, FrontEndView $View)
    {
        $this->Model = $Model;
        $this->View = $View;
    }

    public function test()
    {
        dd($this->View);
    }
}