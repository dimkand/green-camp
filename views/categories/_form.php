<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \app\components\CategoriesHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Categories */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categories-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

    <?php
    $options = [];
    $label = null;
    if(!CategoriesHelper::typePermission($model)){
        $label = "Тип <span class='error'> - для активации удалите вложенные директории</span>";
        $options = ['disabled' => true];
    }
    echo $form->field($model, 'type')->dropDownList(
        CategoriesHelper::getTypes($model->parent), $options
    )->label($label) ?>

    <div><label for="croppic_div_a">Картинка</label></div>
    <div>
        <div id="croppic_div_c"></div>
        <p class="validation_errors"></p>
    </div>
    <input type="hidden" id="cimg" name='cimg'>
    <input type="hidden" name="old_img" value="<?= $model->img;?>">

    <?= $form->field($model, 'parent')->hiddenInput(['value' => $model->parent])->label('') ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
