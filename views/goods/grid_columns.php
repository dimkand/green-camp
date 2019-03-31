<?php
use yii\helpers\Url;
use app\components\Helpers;

return [
    ['class' => 'yii\grid\SerialColumn'],

    [
        'attribute' => '',
        'format' => 'html',
        'filter' => false,
        'headerOptions' => ['width' => '80'],
        'contentOptions' => ['class' => 'grid_td_img'],
        'content' => function ($model) {
            return Helpers::getGoodsImg($model)[0]['content'];
        },
    ],
    'articul',
    'title',
    [
        'attribute' => 'price',
        'format' => ['currency']
    ],
    [
        'attribute' => 'popularFlag',
        'label' => 'П',
        'headerOptions' => ['title' => 'Популярность'],
        'format' => 'text',
        'value' => function ($model) {
            if ($model->popularFlag)
                return 'Да';
            return '';
        }
    ],
    [
        'attribute' => 'saleFlag',
        'label' => 'А',
        'headerOptions' => ['title' => Yii::$app->params['sale_text']],
        'format' => 'text',
        'value' => function ($model) {
            if ($model->saleFlag)
                return 'Да';
            return '';
        }
    ],
    [
        'attribute' => 'freeFlag',
        'label' => 'Д',
        'headerOptions' => ['title' => Yii::$app->params['free_text']],
        'format' => 'text',
        'value' => function ($model) {
            if ($model->freeFlag)
                return 'Да';
            return '';
        }
    ],
    [
        'attribute' => 'date',
        'format' => ['relativeTime']
    ],

    [
        'class' => 'yii\grid\ActionColumn',
        'header' => 'Действия',
        'headerOptions' => ['width' => '80'],
        'urlCreator' => function ($action, $model, $key, $index) use($category_id) {
            if ($action === 'update'){
                return Url::toRoute(['goods/update', 'id' => $model->id, 'category_id' => $category_id]);
            }
            if ($action === 'delete'){
                return Url::toRoute(['goods/delete', 'id' => $model->id, 'category_id' => $category_id]);
            }
            if ($action === 'view') {
                return Url::toRoute(['goods/view', 'id' => $model->id, 'category_id' => $category_id]);
            }
        }
    ],
];