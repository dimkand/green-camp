<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\Orders */

$this->title = 'Оформление заказа';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="orders-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'method_id')->radioList($methods)?>

        <div class="orders-form-bottom">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'region')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'town')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::className(), [
                'mask' => '+9(999) 999-99-99',
                'clientOptions' => [
                    'removeMaskOnSubmit' => true,
                ]
            ]); ?>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Оформить заказ', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>

<?php $this->registerJsFile('js/orders/orders.js', ['depends' => \app\assets\AppAsset::className()]);
