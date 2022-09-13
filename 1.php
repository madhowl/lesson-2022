<?php
include_once ('function.php');

$all_news = getAllNews();

var_dump($all_news);
echo '___________________';
var_dump(getNewsById(3));
echo '___________________';
var_dump($_SERVER['REQUEST_METHOD']);
var_dump($_SERVER['REQUEST_URI']);
