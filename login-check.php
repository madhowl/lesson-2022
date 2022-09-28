<?php
session_start();
include ('function.php');
if (isset($_POST['btnLogin'])){
    if ($_POST['email'] === '11@11.ru' && $_POST['password'] === '123456' ){
        $_SESSION['user'] = 'user';
        goUrl('admin.php');
    }else{
        goUrl('admin.php');
    }

}
