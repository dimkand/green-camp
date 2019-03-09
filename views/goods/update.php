<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Goods */

$this->title = 'Редактирование товара';
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['editlist']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id, 'category_id' => $category_id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="goods-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'all_categories' => $all_categories,
        'categories_id' => $categories_id,
        'category_id' => $category_id
    ]) ?>

</div>
