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
    public function signIn(string $username, int $id){
        $_SESSION['username'] = $username;
        $_SESSION['user_id'] = $id;
    }
    public function signOut(){
        unset($_SESSION['username']) ;
        unset($_SESSION['user_id']) ;
    }
}