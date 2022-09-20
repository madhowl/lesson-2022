<?php
include ('function.php');
include ('tpl/head.tpl');
include ('tpl/nav.tpl');

if(isset($_GET['id'])){
    echo showCard($_GET['id']);
}else{
    echo '<h1>Main Page</h1>';
}

include ('tpl/footer.tpl');
?>





