<?php
include ('function.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];
    removeArticle($id);
    goUrl('json.php');
}else{
    goUrl('json.php');
}