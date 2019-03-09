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
            return Helpers::getGoodsImg($model->id, $model->img_count)[0]['content'];
        },
    ],
    'id',
    'title',
    [
        'attribute' => 'price',
        'format' => ['currency']
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