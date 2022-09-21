<?php
include ('function.php');

if(isset($_POST['send'])){
 $title = $_POST['title'];
 $image = $_POST['image'];
 $content = $_POST['content'];
 addArticle($title, $image, $content);
 goUrl('http://lesson-2022.test/json.php');
}else{
    $article = getArticles();
    foreach ($article as $index){
        echo $index['title'].'&nbsp;';
        echo '<a href="del.php?id='.$index['id'].'">'.'удалить'.'</a><br><br>';
    }
}
?>

<hr>
<form action="" method="post">
    заголовок<br><input type="text" name="title"><br>
    картинка<br><input type="text" name="image"><br>
    содержимое статьи<br>
    <textarea name="content" cols="30" rows="10">

    </textarea>
    <br>
    <input type="submit" name="send" value="добавить"><br>
</form>

