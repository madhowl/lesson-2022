<?php


namespace App\Core;


trait Auth
{
    public function checkAuth()
    {
        if (isset($_SESSION['username'])){
            return true;
        } else return false;
    }
    public function signIn(string $username){
        $_SESSION['username'] = $username;
    }
    public function signOut(){
        unset($_SESSION['username']) ;
    }
}