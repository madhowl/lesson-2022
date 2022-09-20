<?php
// Включаем строгую типизацию
declare(strict_types=1);

function getAllNews():array{
    return [
        1 => [
            'id'=>1,
            'title'=>'Заголовок 1',
            'image' => 'assets/img/blog/blog-1.jpg',
            'content'=> '<p>текст первой новости</p>'
        ],
        2 => [
            'id'=>2,
            'title'=>'Заголовок 2',
            'image' => 'assets/img/blog/blog-2.jpg',
            'content'=> '<p>текст второй новости</p>'
        ],
        3 => [
            'id'=>3,
            'title'=>'Заголовок 3',
            'image' => 'assets/img/blog/blog-3.jpg',
            'content'=> '<p>текст 3 новости</p>'
        ],
        4 => [
            'id'=>4,
            'title'=>'Заголовок 4',
            'image' => 'assets/img/blog/blog-4.jpg',
            'content'=> '<p>текст 4 новости</p>'
        ]
    ];

}
function getNewsById(int $id):array{
    $newslist =getAllNews();
    $singlenews = [];
    if (array_key_exists($id, $newslist)) {
        $singlenews = $newslist[$id];
    }
    return $singlenews;
}
function dd($some){
    echo '<pre>';
    print_r($some);
    echo '</pre>';
}
function getArticleList()
{
    $news = getAllNews();
    $link = '';
    foreach ($news as $n) {
        // URI news.php?id=1
        $link .= '<li class="nav-item"><a class="nav-link" href="index.php?id='. $n['id']
. '">'. $n['title']. '</a></li>';
    }
    return $link;
}
function showCard(int $id)
{
    $article = getNewsById($id);
    $card = '<div class="card">
    <img class="card-img-top" src="' . $article['image'] . '" alt="">
    <div class="card-body">
        <h4 class="card-title">' . $article['title'] . '</h4>
        <p class="card-text">' . $article['content'] . '</p>
    </div>
</div>';
    return $card;
}





