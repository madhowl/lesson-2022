<?php
// Включаем строгую типизацию
declare(strict_types=1);

function getArticleList()
{
    $articles = getArticles();
    $link = '';
    foreach ($articles as $article) {
        // URI news.php?id=1
        $link .= '<li class="nav-item"><a class="nav-link" href="index.php?id='. $article['id']
            . '">'. $article['title']. '</a></li>';
    }
    return $link;
}

function getNewsById(int $id):array{
    $newslist =getArticles();
    $singlenews = [];
    if (array_key_exists($id, $newslist)) {
        $singlenews = $newslist[$id];
    }
    return $singlenews;
}


/**
 * @param $some
 * отладочная функция
 */
function dd($some){
    echo '<pre>';
    print_r($some);
    echo '</pre>';
}

/**
 * @param $url
 * редирект на указаный URL
 */
function goUrl(string $url){
    echo '<script type="text/javascript">location="';
    echo $url;
    echo '";</script>';
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


/// --------- работа со статьями -------///

function getArticles() : array{
    return json_decode(file_get_contents('db/articles.json'), true);
}

function addArticle(array $articleFields) : bool{
    $articles = getArticles();
    $lastId = end($articles)['id'];
    $id = $lastId + 1;
    $articles[$id] = [
        'id' => $id,
        'title' => $articleFields['title'],
        'image' => $articleFields['image'],
        'content' => $articleFields['content']
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

function updateArticle(array $fields):bool{
    $articleItem = checkFields( $_POST, $fields);
    $articles = getArticles();
    if(isset($articles[$articleItem['id']])) {
        $articles[$articleItem['id']] = [
            'id' => $articleItem['id'],
            'title' => $articleItem['title'],
            'image' => $articleItem['image'],
            'content' => $articleItem['content']
        ];
        saveArticles($articles);
        return true;
    }else{
        return false;
    }
}

function checkFields(array $target, array $fields, bool $html=true):array{
    foreach ($fields as $name){
        if(isset($target[$name]) && $html == false) {
            $checkedFields[$name] = trim($target[$name]);
        }elseif (isset($target[$name]) && $html == true) {
            $checkedFields[$name] = htmlspecialchars(string: trim($target[$name]));
        }
    }
    return $checkedFields;

}




///----- Admin Panel----//

function showLoginForm(){
    include ('login.html');
}

