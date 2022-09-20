<?php
$news = getAllNews();
foreach ($news as $n){?>

<div class="col-xl-4 col-md-6">
    <article>
        <div class="post-img">
            <img src="<?php echo $n['image'];?>" alt="" class="img-fluid">
        </div>
        <h2 class="title">
            <a href="#"><?php echo $n['title'];?></a>
        </h2>
    </article>
</div>
    <?php };?>