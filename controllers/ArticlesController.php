<?php

namespace app\controllers;

use app\components\Sitemap;
use app\models\Pages;
use Yii;
use app\models\Articles;
use app\models\ArticlesSearch;
use yii\caching\Cache;
use yii\data\Pagination;
use yii\db\Query;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * ArtclesController implements the CRUD actions for Articles model.
 */
class ArticlesController extends AdminAccessController
{

//    public function behaviors()
//    {
//        return [
//            [
//                'class' => 'yii\filters\HttpCache',
//                'only' => ['showall'],
//                'lastModified' => function ($action, $params) {
//                    $q = new Query();
//                    return strtotime($q->from('articles')->max('date'));
//                },
//                'cacheControlHeader' => 'public, max-age=31536000'
//            ]
//        ];
//    }

    public function actionShow($id)
    {
        $this->layout = 'main';

        return $this->render('show', [
            'model' => $this->findModel($id)
        ]);
    }

    public function actionShowall()
    {
        $this->layout = 'main';

        $query = Articles::find();
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 2, 'validatePage' => false]);
        $models = $query->offset($pages->offset)->limit($pages->limit)->all();
        $model = Pages::findOne('articles');

        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_HTML;

            return $this->renderAjax('articles', [
                'articles' => $models,
                'page' => $pages->page
            ]);
        }

        return $this->render('showall', [
            'model' => $model,
            'models' => $models,
            'page' => $pages->page
        ]);
    }

    /**
     * Lists all Articles models.
     * @return mixed
     */
    public function actionEditlist()
    {
        $searchModel = new ArticlesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('editlist', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Articles model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Articles model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Articles();

        if ($model->load(Yii::$app->request->post()) && $model->save())
            return $this->redirect(['view', 'id' => $model->id]);

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Articles model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save())
            return $this->redirect(['view', 'id' => $model->id]);

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Articles model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();

        return $this->redirect(['editlist']);
    }

    /**
     * Finds the Articles model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Articles the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Articles::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Заданой страницы не существует.');
    }
}
