<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

    <h2>Комментарии</h2>
    <?php foreach ($comments as $k => $i) { ?>
        <p><?= $i->body ?></p>
    <?php } ?>

    <h3>Добавить комментарий</h3>
    <div class="comment-form">
        <?php if (Yii::$app->session->getFlash("comment")) { ?>
        <div class="alert alert-success">
            <?=Yii::$app->session->getFlash("comment")?>
        </div>
        <?php } ?>
        <?php $form = ActiveForm::begin([
            "action" => ["site/comment", "id" => $news->id]
        ]); ?>

        <?= $form->field($commentForm, 'comment')->textarea(['rows' => 6]) ?>

        <div class="form-group">
            <?= Html::submitButton("Добавить", ['class' => "btn btn-primary"]) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

    <p><?= Html::a("Вернуться к списку", ["news/index"], ["class" => "btn btn-default"]) ?></p>