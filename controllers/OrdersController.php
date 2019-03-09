<?php

namespace app\controllers;

use app\components\Helpers;
use app\models\Goods;
use app\models\Methods;
use app\models\OrdersGoods;
use app\models\Users;
use Yii;
use app\models\Orders;
use app\models\OrdersSearch;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrdersController implements the CRUD actions for Orders model.
 */
class OrdersController extends AdminAccessController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
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
     * Lists all Orders models.
     * @return mixed
     */
    public function actionEditlist()
    {
        $searchModel = new OrdersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('editlist', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Orders model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $ord_table = OrdersGoods::tableName();
        $gd_table = Goods::tableName();
        $dataProvider = new ActiveDataProvider([
            'query' => $model->getGoods()->select("$ord_table.goods_id, $ord_table.goods_count, $gd_table.id, $gd_table.img_count, $gd_table.price, $gd_table.title")->joinWith('goods', true),
            'sort' => false
        ]);

        return $this->render('view', [
            'model' => $model,
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionViewgood($id, $order_id)
    {
        $model = Goods::findOne($id);
        return $this->render('viewgood', [
            'model' => $model,
            'order_id' => $order_id
        ]);
    }

    /**
     * Creates a new Orders model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->cart->getCount() == 0)
            $this->redirect('/');

        $this->layout = 'main';

        $model = new Orders();

        $model->method_id = 1;

        $methods = Methods::find()->asArray()->all();
        $methods = ArrayHelper::map($methods, 'id', 'title');

        if ($model->load(Yii::$app->request->post()) && $goods = $model->save()) {
            $email = Users::find()->select('email')->where(['group_id' => Users::GROUP_ID_ADMIN])->scalar();
            $text = $this->render('@app/mail/order_mail_tpl', [
                'model' => $model,
                'goods' => $goods
            ]);
            Yii::$app->mailer->compose()
                ->setTo($email)
                ->setFrom(Yii::$app->params['siteEmail'])
                ->setSubject('Заказ №' . $model->id)
                ->setHtmlBody($text)
                ->send();

            return $this->redirect(['/methods/show', 'id' => $model->method_id]);
        }

        return $this->render('create', [
            'model' => $model,
            'methods' => $methods
        ]);
    }

    /**
     * Updates an existing Orders model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Orders model.
     * If deletion is successful, the browser will be redirected to the 'editlist' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        OrdersGoods::deleteAll(['orders_id' => $id]);
        $this->findModel($id)->delete();

        return $this->redirect(['editlist']);
    }

    public function actionDeletegood($id, $order_id)
    {
        OrdersGoods::deleteAll(['goods_id' => $id, 'orders_id' => $order_id]);
        $this->redirect(['view', 'id' => $order_id]);
    }

    /**
     * Finds the Orders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Orders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Orders::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Заданой страницы не существует.');
    }
}
