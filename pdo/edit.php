<?php
require_once ('function.php');
if (isset($_GET['id'])){
    $id = $_GET['id'];
    $work = getWorkByid($id);
     echo  showForm('update.php','Редактирование',$work['work_name'],['id'=>$work['id']]);

}

