<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\components\Helpers;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ParamsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Телефоны';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="params-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute'=>'tel1',
                'format' => 'text',
                'content' => function ($model) {
                    return Helpers::parsePhone($model->tel1);
                },
            ],
            [
                'attribute'=>'tel2',
                'format' => 'text',
                'content' => function ($model) {
                    return Helpers::parsePhone($model->tel2);
                },
            ],

    [
    'class' => 'yii\grid\ActionColumn',
    'header'=>'Действия',
        'template' => '{update}',
    'headerOptions' => ['width' => '80'],
    ],
    ],
    ]); ?>
</div>
