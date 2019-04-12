<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Params */

$this->title = 'Редактирование телефонов';
$this->params['breadcrumbs'][] = ['label' => 'Телефоны', 'url' => ['editlist']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="params-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
