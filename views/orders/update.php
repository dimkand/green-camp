<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Orders */

$this->title = 'Редактирование заказа';
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['editlist']];
$this->params['breadcrumbs'][] = ['label' => 'Заказ №'.$model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="orders-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="orders-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::className(), [
            'mask' => '+9(999) 999-99-99',
            'clientOptions' => [
                'removeMaskOnSubmit' => true,
            ]
        ]); ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
