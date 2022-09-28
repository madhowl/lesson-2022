<?php
session_start();
include ('function.php');
unset($_SESSION['user']);
goUrl('admin.php');
