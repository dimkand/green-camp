<?php

namespace app\controllers;

use app\components\Helpers;
use app\models\Categories;
use Yii;
use app\models\Goods;
use app\models\GoodsSearch;
use yii\web\NotFoundHttpException;
use app\models\Params;

/**
 * GoodsController implements the CRUD actions for Goods model.
 */
class GoodsController extends AdminAccessController
{

    public function actionShow($alias)
    {
        $this->layout = 'main';

        $tels = Params::find()->one();

        $model = Goods::findOne(['alias' => $alias]);
        return $this->render('show', ['model' => $model, 'tels' => $tels]);
    }

    /**
     * Lists all Goods models.
     * @return mixed
     */
    public function actionEditlist($alias = false)
    {
        $searchModel = new GoodsSearch();
        $categories = Categories::find()->indexBy('id')->all();

        if($alias)
            $model = Categories::findOne(['alias' => $alias]);
        else
            $model = new Categories();

        if (isset($model->id) && $model->id)
            $goods_id_array = $categories[$model->id]->getGoodsId();
        else
            $goods_id_array = Goods::find()->asArray()->column();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $goods_id_array);

        return $this->render('editlist', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'categories' => $categories,
            'category_id' => $model->id ?? 0,
            'model' => $model
        ]);
    }

    /**
     * Displays a single Goods model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id, $category_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id), 'category_id' => $category_id
        ]);
    }

    /**
     * Creates a new Goods model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($category_id)
    {
        $model = new Goods();
        $model->popularFlag = 0;
        $all_categories = Categories::find()->all();

        if ($model->load(Yii::$app->request->post()) && $model->save())
            return $this->redirect(['goods/editlist', 'id' => $category_id]);

        return $this->render('create', [
            'model' => $model,
            'all_categories' => $all_categories,
            'category_id' => $category_id
        ]);
    }

    /**
     * Updates an existing Goods model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $category_id)
    {
        $model = Goods::findOne($id);
        $categories_id = $model->getCategoriesId()->select('category_id')->column();
        $all_categories = Categories::find()->all();

        if ($model->load(Yii::$app->request->post()) && $model->save())
            return $this->redirect(['goods/editlist', 'id' => $category_id]);

        return $this->render('update', [
            'model' => $model,
            'all_categories' => $all_categories,
            'categories_id' => $categories_id,
            'category_id' => $category_id
        ]);
    }

    public function actionDelete($id, $category_id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['editlist', 'id' => $category_id]);
    }

    public function actionDeleteajax()
    {
        $model = Goods::findOne($_POST['id']);
        $img_path = Helpers::editCimgPath($_POST['old_img']);
        if ($is_delete = ($model->deleteImgFile($_POST['old_img']) && ($model->deleteImgFile($img_path))))
            Goods::findOne($_POST['id'])->updateCounters(['img_count' => -1]);
        return $is_delete;
    }

    /**
     * Finds the Goods model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Goods the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Goods::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Заданой страницы не существует.');
    }
}
