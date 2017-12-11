<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\News;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;
use app\models\CommentForm;

class NewsController extends Controller {

    function actionIndex() {
        $query = News::find()->where(["status" => 1]);
        $owner = 1;
        if (!empty($_GET["order"])) {
            $owner = (int) $_GET["order"];
        }
        if ($owner == 1) {
            $query = $query->orderBy("dt DESC");
        } else {
            $query = $query->orderBy("dt ASC");
        }

        $count = $query->count();
        $pagination = new Pagination([
            "totalCount" => $count,
            "pageSize" => 3,
            "params" => array_merge($_GET, ["order" => $owner])
        ]);

        $news = $query->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();
        
        return $this->render("index", [
            "news" => $news,
            "pagination" => $pagination
        ]);
    }

    function actionView() {
        $newsName = explode("/", Yii::$app->request->pathInfo)[1];
        $query = News::find()->where(["name"=> $newsName]);
        $news = $query->one();
        
        $comments = $news->comment;
        
        $commentForm = new CommentForm();
        
        if (empty($news)) {
            throw new NotFoundHttpException("Новость не найдена");
        }
        
        //return $this->render("view", ["news"=>$news]);
        return $this->render("view", compact("news", "comments", "commentForm"));
    }

}
