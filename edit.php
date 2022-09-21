<?php
include ('function.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $article = editArticle($id);
}

?>

<form action="update.php" method="post">
    заголовок<br><input type="text" name="title" value="<?=$article['title'];?>"><br>
    <input type="hidden" name="id" value="<?=$id;?>">
    картинка<br><input type="text" name="image" value="<?=$article['image'];?>"><br>
    содержимое статьи<br>
    <textarea name="content" cols="30" rows="10" >
        <?=$article['content'];?>
    </textarea>
    <br>
    <input type="submit" name="btnEdit" value="Сохранить"><br>
</form>
