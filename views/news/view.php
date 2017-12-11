<?php

$this->title = $news->name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= $news->name ?></h1>
    <h3><?= date("d.m.Y", strtotime($news->dt)) ?> <?= $news->categoryModel->name ?></h3>
    <p><?= $news->body ?></p>

    <?= $this->render('/site/comments', compact("news", "comments", "commentForm")) ?>
</div>
