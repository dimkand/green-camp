<?php

namespace app\controllers;

use app\components\CategoriesHelper;
use app\components\Helpers;
use app\models\Goods;
use app\models\GoodsCategories;
use Yii;
use app\models\Categories;
use app\models\CategoriesSearch;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * CategoriesController implements the CRUD actions for Categories model.
 */
class CategoriesController extends AdminAccessController
{
    public function actionShow($id = null)
    {
        $this->layout = 'main';

        $chars_values_id = $_GET;
        unset($chars_values_id['page']);
        unset($chars_values_id['per-page']);
        unset($chars_values_id['id']);

        $model = Categories::findOne($id);

        if(empty($chars_values_id) && ($model == false || $model->type == 1)){
            if(is_null($id))
                $id = 0;
            $query = Categories::find()->where(['parent' => $id]);
            $view = 'categories_show';
        }else{
            $query = Categories::find()->select('goods.id, goods.articul, goods.title, goods.description, goods.keywords, goods.text, goods.img_count, goods.price, goods.rating, goods.saleFlag, goods.freeFlag')->filterWhere(['in', 'categories.id', $chars_values_id])->andFilterWhere(['categories.id' => $id])->andWhere(['not', ['goods.id' => 'NULL']])->joinWith('goods')->orderBy('goods.id')->asArray();
            $view = 'goods_show';
        }

        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 6, 'params' => $_GET]);
        $data = $query->offset($pages->offset)->limit($pages->limit)->all();

        if (Yii::$app->request->isAjax && isset($_GET)){
            if (empty($data))
                $html = $this->renderPartial('@views/pages/info', ['message' => 'По вашему запросу ничего не найдено']);
            else
                $html = $this->renderPartial($view, ['data' => $data, 'pages' => $pages]);

            return $html;

        }else{
            $rawCategories = Categories::find()->indexBy('id')->all();
            $categories = CategoriesHelper::createItems($rawCategories, CategoriesHelper::$CATEGORIES_FLAG, '/categories/show');
            $chars = CategoriesHelper::createItems($rawCategories, CategoriesHelper::$CHARS_FLAG, '', $id);

            return $this->render('show', [
                'data' => $data,
                'pages' => $pages,
                'categories' => $categories,
                'chars' => $chars,
                'model' => $model
            ]);
        }
    }

    /**
     * Lists all Categories models.
     * @return mixed
     */
    public function actionEditlist($id = 0)
    {
        $searchModel = new CategoriesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $id);

        return $this->render('editlist', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'id' => $id
        ]);
    }

    /**
     * Creates a new Categories model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new Categories();
        $model->parent = $id;

        if ($model->load(Yii::$app->request->post()) && $model->save())
            return $this->redirect(['categories/editlist/', 'id' => $model->parent]);

        return $this->render('create', [
            'model' => $model
        ]);
    }

    /**
     * Updates an existing Categories model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save())
            return $this->redirect(['categories/editlist/', 'id' => $model->parent]);

        return $this->render('update', [
            'model' => $model
        ]);
    }

    /**
     * Deletes an existing Categories model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        GoodsCategories::deleteAll(['category_id' => $id]);
        $model->delete();

        return $this->redirect(['categories/editlist/', 'id' => $model->parent]);
    }

    /**
     * Finds the Categories model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Categories the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Categories::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Заданой страницы не существует.');
    }

    private function allowCreate($id)
    {
        $category = Categories::findOne(['id' => $id]);
        if ($category == false)
            return true;
        return $category->getGoods()->count() == 0;
    }
}
