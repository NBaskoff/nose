<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use app\models\Category;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Новости</h1>
    </div>
    <div class="body-content">
        <div class="row">
            <div class="col-md-12">
            <?php foreach (Category::findOne(1)->children()->all() as $k=>$i) {?>
                <?php if ($i->countNews > 0) { ?>
                    <?php for ($n = 1; $n < $i->depth; $n++) { ?>
                        &nbsp;&nbsp;&nbsp;
                    <?php } ?>
                    <?=$i->name?> (<?=$i->countNews?>)<br>
                <?php } ?>
            <?php } ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?=Html::a("Сначала новые", ["news/index", "order"=>1])?>
                <?=Html::a("Сначала старые", ["news/index", "order"=>2])?>
            </div>
        </div>        
        <div class="row">
            <?php if (!empty($news)) foreach ($news as $k=>$i) { ?>
            <div class="col-lg-4">
                <h2><?=date("d.m.Y", strtotime($i->dt))?> <?=$i->name?></h2>
                <h3><?=$i->categoryModel->name?></h3>
                <p><?=$i->preview?></p>
                <p><?=Html::a("Подробнее", ["news/".Html::encode($i->name)], ["class"=>"btn btn-default"])?></p>
            </div>
            <?php } ?>
        </div>
    </div>
    
    <?=LinkPager::widget(["pagination" => $pagination])?>
    
</div>
