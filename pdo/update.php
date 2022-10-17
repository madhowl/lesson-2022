<?php
require_once ('function.php');
if (isset($_POST['id']) && isset($_POST['work'])){
    $id = $_POST['id'];
    $work = $_POST['work'];
    updateWork($id,$work);
    header("Location: index.php");

}