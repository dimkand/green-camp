<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CategoriesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категории';
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['editlist']];
$this->render('_breadcrumbs', ['id' => $id, 'route' => 'editlist']);


?>
<div class="categories-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php echo Html::a('Создать', ['create', 'id' => $id], ['class' => 'btn btn-success']); ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => '',
                'format' => 'html',
                'filter' => false,
                'headerOptions' => ['width' => '80'],
                'contentOptions' => ['class' => 'grid_td_img'],
                'content' => function ($data) {
                    return "<img src='" . Url::base(true) . '/' . $data->img . "' class='grid_img widget_img'>";
                },
            ],
            [
                'attribute' => 'title',
                'format' => 'html',
                'content' => function ($data) {
                    if ($data->type == 4)
                        return "<button class='btn btn-success'>$data->title</button>";
                    else
                        return Html::a($data->title, ['editlist', 'id' => $data->id], ['class' => 'btn btn-success']);
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'header' => 'Действия',
                'headerOptions' => ['width' => '80'],
            ],
        ],
    ]); ?>
</div>
