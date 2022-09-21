<?php
include ('function.php');

if(isset($_POST['btnEdit'])){
    $id = $_POST['id'];
    $title = $_POST['title'];
    $image = $_POST['image'];
    $content = $_POST['content'];
    updateArticle( $title, $image, $content, $id);
    goUrl('http://lesson-2022.test/json.php');

}else{

    goUrl('http://lesson-2022.test/json.php');

}