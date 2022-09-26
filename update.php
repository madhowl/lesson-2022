<?php
include ('function.php');

if(isset($_POST['btnEdit'])){
    $fields =['id', 'title', 'image', 'content'];
    updateArticle( $fields);
    goUrl('json.php');

}else{

    goUrl('json.php');

}