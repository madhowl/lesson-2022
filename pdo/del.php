<?php
include("function.php");
if (isset($_GET['id'])){
    $id = (int)$_GET['id'];
    delWork($id);
}
header("Location: index.php");
