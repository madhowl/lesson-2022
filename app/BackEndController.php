<?php
declare(strict_types=1);


namespace App;


use App\Core\Auth;
use App\Core\ModelInterface;
use App\Models\UsersModel;

class BackEndController
{
use Auth;

    private  $View;
    private  ModelInterface $User;

    /**
     * TodoController constructor.
     */
    public function __construct()
    {
        $this->View = new BackEndView();
        $this->User = new UsersModel('','');

    }
    public function showDashboard()
    {
        if ($this->checkAuth()){
            $this->View->index();

        }else{
            $this->showSignInForm();
        }
    }
    public function showSignInForm()
    {
        $this->View->showSignInForm();
    }
    public function showSignUpForm()
    {
        $this->View->showSignUpForm();
    }

}