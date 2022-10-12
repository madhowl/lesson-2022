<?php
include ("function.php");
if (isset($_POST['btnWork'])) {
    $newWork = $_POST['work'];
    addNewWork($newWork);
}else{
    echo 'aksjfgvh';
}
