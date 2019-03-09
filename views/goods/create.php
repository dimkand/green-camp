<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Goods */

$this->title = 'Создание товара';
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['editlist']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'all_categories' => $all_categories,
        'category_id' => $category_id
    ]) ?>

</div>
