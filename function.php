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
function goUrl(string $url){
    echo '<script type="text/javascript">location="';
    echo $url;
    echo '";</script>';
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




function getArticles() : array{
    return json_decode(file_get_contents('db/articles.json'), true);
}

function addArticle(string $title, string $image, string $content) : bool{
    $articles = getArticles();

    $lastId = end($articles)['id'];
    $id = $lastId + 1;

    $articles[$id] = [
        'id' => $id,
        'title' => $title,
        'image' => $image,
        'content' => $content
    ];

    saveArticles($articles);
    return true;
}

function removeArticle(int $id) : bool{
    $articles = getArticles();

    if(isset($articles[$id])){
        unset($articles[$id]);
        saveArticles($articles);
        return true;
    }

    return false;
}

function saveArticles(array $articles) : bool{
    file_put_contents('db/articles.json', json_encode($articles));
    return true;
}

function editArticle(int $id) : array{
    $articles = getArticles();
    $article =[];
    if(isset($articles[$id])){
        $article = $articles[$id];
    }
    return $article;
}

function updateArticle(string $title, string $image, string $content,int $id):bool{
    $articles = getArticles();

    if(isset($articles[$id])) {
        $articles[$id] = [
            'id' => $id,
            'title' => $title,
            'image' => $image,
            'content' => $content
        ];
        saveArticles($articles);
        return true;
    }else{
        return false;
    }
}
