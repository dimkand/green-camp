<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Params */

$this->title = 'Создание Params';
$this->params['breadcrumbs'][] = ['label' => 'Params', 'url' => ['editlist']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="params-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>