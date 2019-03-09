<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactsForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->registerMetaTag(['name' => 'description', 'content' => $model->description]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $model->keywords]);

$this->title = 'Контакты';

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

        <div class="alert alert-success">
            Спасибо что связались с нами.
        </div>

    <?php else: ?>

        <p id="contact_p">
            Если у вас есть деловое предложение, напишите нам.
        </p>

        <div class="row">
            <div class="col-lg-5">

                <?php $form = ActiveForm::begin(['id' => 'contact_form']); ?>

                    <?= $form->field($model_contacts, 'name')->textInput(['autofocus' => true]) ?>
                    <?= $form->field($model_contacts, 'email') ?>
                    <?= $form->field($model_contacts, 'subject') ?>
                    <?= $form->field($model_contacts, 'body')->textarea(['rows' => 6]) ?>
                    <?= $form->field($model_contacts, 'verifyCode')->widget(Captcha::className(), [
                        'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                    ]) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Отправить', ['class' => 'btn btn-success', 'name' => 'contact-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>

    <?php endif; ?>
</div>

<?php $this->registerJsFile(YII_ENV_DEV ? 'js/pages/contacts.js' : 'js/pages/contacts.min.js', ['depends' => \app\assets\AppAsset::className()]);