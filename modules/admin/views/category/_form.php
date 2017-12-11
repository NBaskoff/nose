<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;

use app\widgets\CustomActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\News */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = CustomActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'parent')->nestedSetSelector($model->maybeParents, ["class"=>"modal-radio"]) ?>

    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php CustomActiveForm::end(); ?>

</div>
