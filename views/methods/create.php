<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Methods */

$this->title = 'Создание Метода';
$this->params['breadcrumbs'][] = ['label' => 'Методы доставки', 'url' => ['editlist']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="methods-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
