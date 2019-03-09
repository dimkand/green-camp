<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use app\components\Helpers;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Orders */

$this->title = 'Заказ №'.$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['editlist']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить этот элемент?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'address',
            [
                'attribute'=>'phone',
                'format' => 'text',
                'value' => (Helpers::parsePhone($model->phone))
            ],
            'date',
        ],
    ]) ?>

    <b>Заказанные товары</b>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => '',
                'format' => 'html',
                'filter' => false,
                'headerOptions' => ['width' => '80'],
                'contentOptions' => ['class' => 'grid_td_img'],
                'content' => function ($good_model) {
                    return Helpers::getGoodsImg($good_model->goods->id, $good_model->goods->img_count)[0]['content'];
                },
            ],
            [
                'attribute' => 'title',
                'label' => 'Наименование товара',
                'value' => 'goods.title'
            ],
            [
                'attribute' => 'price',
                'label' => 'Цена',
                'value' => 'goods.price',
                'format' => ['currency']
            ],
            [
                'attribute' => 'goods_count',
                'label' => 'Количество'
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {delete}',
                'header' => 'Действия',
                'headerOptions' => ['width' => '80'],
                'urlCreator' => function ($action, $good_model, $key, $index) use($model){
                    if ($action === 'delete'){
                        return Url::toRoute(['orders/deletegood', 'id' => $good_model->goods->id, 'order_id' => $model->id]);
                    }
                    if ($action === 'view') {
                        return Url::toRoute(['orders/viewgood', 'id' => $good_model->goods->id, 'order_id' => $model->id]);
                    }
                }
            ],
        ]
    ]); ?>

</div>
