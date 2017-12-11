<?php

namespace app\widgets;

use yii\widgets\ActiveForm;

class CustomActiveForm extends ActiveForm {

    public $fieldClass = 'app\widgets\CustomActiveField';

}
