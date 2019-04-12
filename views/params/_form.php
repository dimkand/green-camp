<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model app\models\Params */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="params-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tel1')->widget(MaskedInput::className(), [
        'mask' => '+9(999) 999-99-99',
        'clientOptions' => [
            'removeMaskOnSubmit' => true,
        ]
    ]); ?>

    <?= $form->field($model, 'tel2')->widget(MaskedInput::className(), [
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
