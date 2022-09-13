<?php
// Включаем строгую типизацию
declare(strict_types=1);

function getAllNews():array{
    $news = [
        1 => [
            'title'=>'Заголовок 1',
            'image' => 'assets/img/blog/blog-1.jpg',
            'content'=> '<p>текст первой новости</p>'
        ],
        2 => [
            'title'=>'Заголовок 2',
            'image' => 'assets/img/blog/blog-2.jpg',
            'content'=> '<p>текст второй новости</p>'
        ],
        3 => [
            'title'=>'Заголовок 3',
            'image' => 'assets/img/blog/blog-3.jpg',
            'content'=> '<p>текст 3 новости</p>'
        ],
        4 => [
            'title'=>'Заголовок 4',
            'image' => 'assets/img/blog/blog-4.jpg',
            'content'=> '<p>текст 4 новости</p>'
        ]
    ];
    return $news;
}
function getNewsById(int $id):array{
    $newslist =getAllNews();
    $singlenews = [];
    if (array_key_exists($id, $newslist)) {
        $singlenews = $newslist[$id];
    }
    return $singlenews;
}
