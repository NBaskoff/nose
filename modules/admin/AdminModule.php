<?php

namespace app\modules\admin;

use Yii;
use yii\base\Module;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

/**
 * admin module definition class
 */
class AdminModule extends Module
{
    /**
     * @inheritdoc
     */
    public $layout = "/admin";
    public $controllerNamespace = 'app\modules\admin\controllers';

    public function behaviors() {
        return [
            "access" => [
                "class" => AccessControl::className(),
                "denyCallback" => function ($rule, $action) {
                    throw new NotFoundHttpException();
                },
                "rules" => [
                    [
                        "allow" => true,
                        "matchCallback" => function($rule, $action) {
                            return !Yii::$app->user->isGuest;
                        }
                    ]
                ]
            ]
        ];
    }
    
    
    public function init()
    {
        parent::init();
    }
}
