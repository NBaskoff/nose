<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Category;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex($id) {
        $category = Category::findOne((int) $id);
        $records = $category->children(1)->all();
        $pageData = $this->getPageData($category);
        return $this->render('index', compact("records", "id", "pageData"));
    }

    /**
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id) {
        $model = new Category();
        $model->parent = $id;
        if ($model->load(Yii::$app->request->post()) && $model->appendTo($this->findModel($model->parent))) {
            return $this->redirect(['index', 'id' => $model->parent]);
        } else {
            return $this->render('create', [
                        'model' => $model,
                        "parentId" => $id,
                        "pageData" => $this->getPageData(Category::findOne($id))
            ]);
        }
    }

    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->appendTo($this->findModel($model->parent));
            return $this->redirect(['index', 'id' => $model->parent]);
        } else {
            return $this->render('update', [
                        'model' => $model,
                        "parentId" => $model->parents(1)->one()->id,
                        "pageData" => $this->getPageData($model)
            ]);
        }
    }

    /**
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $category = $this->findModel($id);
        $parent = $category->parents(1)->one();
        $category->delete();
        return $this->redirect(['index', "id" => $parent->id]);
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     *
     * @param Category $category Категория
     * @return Array
     */
    public function getPageData(Category $category) {
        $parents = $category->parents()->all();
        $pageTitle = [];
        $breadcrumbs = [];
        if (!empty($parents))
            foreach ($parents as $k => $i) {
                $pageTitle[] = $i->name;
                $breadcrumbs[] = [
                    "url" => ["/admin/category/index", "id" => $i->id],
                    "label" => $i->name
                ];
            }
        $breadcrumbs[] = [
            "label" => $category->name
        ];
        $pageTitle[] = $category->name;
        $pageTitle = implode(" :: ", $pageTitle);

        return [
            "title" => $pageTitle,
            "breadcrumbs" => $breadcrumbs,
        ];
    }

}
