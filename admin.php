<?php
session_start();
include_once ('function.php');
if (isset($_SESSION['user'])){
    include_once ('dashboard/dashboard.html');

}else{
    showLoginForm();
}
