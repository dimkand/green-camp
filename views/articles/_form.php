<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Articles */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="articles_form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>

    <div><label for="croppic_div_a">Катринка</label></div>
    <div>
        <div id="croppic_div_a"></div>
        <p class="validation_errors"></p>
    </div>
    <input type="hidden" id="cimg" name='cimg'>
    <input type="hidden" name="old_img" value="<?= $model->img;?>">

    <?= $form->field($model, 'text')->textarea(['rows' => 6, 'id' => 'ckedit']) ?>

    <?= $form->field($model, 'date')->input('date', ['type' => 'hidden'])->label('') ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php $this->registerJsFile('js/ckeditor_add.js', ['depends' => \app\assets\AppAssetAdmin::className()])?>