<?php

use yii\helpers\Html;
use app\widgets\CustomActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Category;
/* @var $this yii\web\View */
/* @var $model app\models\News */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-form">

    <?php $form = CustomActiveForm::begin(); ?>

    <?= $form->field($model, 'dt')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'preview')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->dropDownList([1=>"Показывать", 2=>"Скрывать"]) ?>
    
    <?= $form->field($model, 'category')->nestedSetSelector(Category::findOne(1)->children()->all(), ["class"=>"modal-radio"]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php CustomActiveForm::end(); ?>

</div>
