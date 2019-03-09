<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Редактирование пароля';
$this->params['breadcrumbs'][] = $this->title;
?>

<div>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pass')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pass_repeat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'old_pass')->textInput(['maxlength' => true]) ?>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>