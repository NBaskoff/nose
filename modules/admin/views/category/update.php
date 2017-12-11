<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\News */

$this->title = 'Редактирование: ' . $model->name;
$this->params['breadcrumbs'] = $pageData["breadcrumbs"];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="news-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        "parentId" => $parentId
    ]) ?>

</div>
