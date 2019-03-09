<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Methods */

$this->title = 'Редактирование метода';
$this->params['breadcrumbs'][] = ['label' => 'Методы доставки', 'url' => ['editlist']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="methods-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
