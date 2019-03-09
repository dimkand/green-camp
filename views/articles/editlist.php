<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArticlesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Статьи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="articles-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить статью', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute'=>'',
                'format' => 'html',
                'filter' => false,
                'headerOptions' => ['width' => '80'],
                'contentOptions' => ['class' => 'grid_td_img'],
                'content' => function($model) {
                    return "<img src='".\yii\helpers\Url::base(true).'/'.$model->img."' class='grid_img widget_img'>";
                },
            ],

            'title',
            'author',
            [
                'attribute' => 'date',
                'format' => ['relativeTime']
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Действия',
                'headerOptions' => ['width' => '80'],
            ],
        ],
    ]); ?>
</div>
