<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Категории';
$this->params['breadcrumbs'] = $pageData['breadcrumbs'];
?>
<div class="category-index">
    <h1><?=$pageData['title']?></h1>
    <p>
        <?= Html::a('Добавить категорию', ['create', "id"=>$id], ['class' => 'btn btn-success']) ?>
    </p>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Название</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($records)) foreach ($records as $k=>$i) { ?>
            <tr>
                <td><?=$i->id?></td>
                <td><?=Html::a($i->name. " (".$i->children()->count() .")", ["index", "id"=>$i->id]);?></td>
                <td>
                    <?=Html::a(Html::tag("span", "", ["class"=>"glyphicon glyphicon-pencil"]), ["update", "id"=>$i->id])?>
                    <?=Html::a(
                        Html::tag("span", "", ["class"=>"glyphicon glyphicon-trash"]),
                        ["delete", "id"=>$i->id],
                        [
                            "data" => [
                                "pjax" => 0,
                                "confirm" => "Удалить '{$i->name}'?",
                                "method" => 'post'
                            ]
                        ]
                    )?>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
