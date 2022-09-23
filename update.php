<?php
include ('function.php');

if(isset($_POST['btnEdit'])){
    $fields =['id', 'title', 'image', 'content'];
    updateArticle( $fields);
    goUrl('http://lesson-2022.test/json.php');

}else{

    goUrl('http://lesson-2022.test/json.php');

}