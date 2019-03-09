<?php
use app\components\Helpers;
use yii\helpers\Html;

echo \yii\widgets\DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'title',
        'description',
        'keywords',
        [
            'attribute'=>'text',
            'format' => 'html',
            'value'=>($model->text)
        ],
        [
            'attribute'=>'img',
            'format' => 'raw',
            'value'=>(
            \yii\bootstrap\Carousel::widget([
                'items' => Helpers::getGoodsImg($model->id, $model->img_count, ['class' => 'grid_img']),
                'options' => ['class' => 'slide'],
                'controls' => [
                    Html::tag('span', '', ['class' => 'glyphicon glyphicon-chevron-left']),
                    Html::tag('span', '', ['class' => 'glyphicon glyphicon-chevron-right']),
                ],

            ])
            )
        ],
        [
            'attribute' => 'price',
            'format' => ['currency']
        ],
        [
            'attribute' => 'date',
            'format' => ['datetime', 'medium']
        ],
        [
            'attribute'=>'rating',
            'format' => 'raw',
            'value' => (
            \kartik\rating\StarRating::widget([
                'name' => 'rating_add',
                'value' => $model->rating,
                'pluginOptions' => [
                    'displayOnly' => true,
                    'showClear' => false,
                    'showCaption' => true,
                    'readonly' => true
                ]
            ])
            )
        ],
    ],
]);