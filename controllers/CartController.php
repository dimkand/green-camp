<?php

namespace app\controllers;

use Yii;
use app\models\Goods;
use yii\web\Controller;

class CartController extends Controller
{
    public function actionShow()
    {
        return $this->render('show');
    }

    public function actionAdd()
    {
        if (!Yii::$app->request->isAjax || !isset($_POST['id']))
            return false;

        $model = Goods::findOne($_POST['id']);
        Yii::$app->cart->add($model);
        return json_encode(Yii::$app->cart->getCount());
    }

    public function actionClear()
    {
        Yii::$app->cart->clear();
        return true;
    }

    public function actionChangequantity()
    {
        if(!Yii::$app->request->isAjax || !isset($_POST['id']) || !isset($_POST['value']))
            return false;

        return Yii::$app->cart->changeQuantity($_POST['id'], $_POST['value']);
    }

    public function actionDelete()
    {
        if(!Yii::$app->request->isAjax || !isset($_POST['id']))
            return false;

        Yii::$app->cart->remove($_POST['id']);
        return true;
    }
}