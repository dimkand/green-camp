<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\nav\NavX;
use app\components\CategoriesHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GoodsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Товары';
$this->params['breadcrumbs'] = array();
$this->render('@app/views/categories/_breadcrumbs', ['id' => $category_id, 'route' => 'editlist']);
$this->params['breadcrumbs'][] = $this->title;
?>

<div id="wrapper">

    <div id="sidebar-left">
        <h4>Категории</h4>
        <?php
        echo Html::a('Все товары', ['goods/editlist']);
        $params = CategoriesHelper::createItems($categories, CategoriesHelper::$CATEGORIES_FLAG, Yii::$app->homeUrl . 'goods/editlist/');

        echo NavX::widget(
            $params
        );
        NavX::registerDropDownOnHoverScript();
        ?>
    </div>

    <div class="goods-index">

        <h1><?= Html::encode($this->title) ?></h1>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <p>
            <?php if ($model->type != 2 && $model->type != 0):?>
                <button class = 'btn btn-success' disabled = "true">Добавить товар</button>
            <?php else:
                echo Html::a('Добавить товар', ['create', 'category_id' => $category_id], ['class' => 'btn btn-success']);
            endif; ?>
        </p>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => require __DIR__ . '/grid_columns.php',
        ]); ?>
    </div>
</div>
