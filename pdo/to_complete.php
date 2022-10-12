<?php
require_once ('function.php');
if (isset($_GET['id'])){
    $id = $_GET['id'];
    $work = getWorkByid($id);
    changeStatus($work);


}

