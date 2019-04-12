<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use app\components\CategoriesHelper;
use dksoft\widgets\DropDownMenu;
use app\models\Goods;
use kartik\rating\StarRating;
use kartik\switchinput\SwitchInput;

/* @var $this yii\web\View */
/* @var $model app\models\Goods */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="goods_form">

    <?php $form = ActiveForm::begin(['action' => Url::current(['category_id' => $category_id])]); ?>

    <?= $form->field($model, 'articul')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'id' => 'goods_form_title', 'ref' => 'title', '@input' => 'autoFill']) ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true, 'id' => 'goods_form_description', 'ref' => 'description']) ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true, 'id' => 'goods_form_keywords', 'ref' => 'keywords']) ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6, 'id' => 'ckedit']) ?>

    <div class="goods_form_switch">
        <?= $form->field($model, 'price')->textInput() ?>

        <?= $form->field($model, 'popularFlag')->widget(SwitchInput::classname(), [
            'type' => SwitchInput::CHECKBOX
        ]);?>

        <?= $form->field($model, 'saleFlag')->widget(SwitchInput::classname(), [
            'type' => SwitchInput::CHECKBOX
        ])->label('Скидка в подарок');?>

        <?= $form->field($model, 'freeFlag')->widget(SwitchInput::classname(), [
            'type' => SwitchInput::CHECKBOX
        ])->label('Бесплаткая доставка');?>

        <?php echo $form->field($model, 'rating')->label('Оценка')->widget(StarRating::classname(), [
            'name' => 'rating_add',
            'pluginOptions' => [
                'showClear' => false,
                'showCaption' => true,
            ]
        ]); ?>
    </div>

    <div class="has-error">
        <?php
        $config = CategoriesHelper::createItems($all_categories);
        $config['title'] = 'Выбрать категории';
        $config['name'] = 'Goods[categories]';
        $config['tags'] = true;
        $config['checked'] = $categories_id ?? array($category_id);
        echo DropDownMenu::widget($config);
        ?>
        <div class="help-block"><?= $model->getErrors('categories')[0] ?? '' ?></div>
    </div>

    <div><label for="croppic_div_t">Картинка</label></div>
    <div id="goods_form_ims">
        <form-img-container base-url="<?=Url::base(true)?>" id="<?=$model->id?>" img-count="<?= $model->img_count?>" img-path="<?=Goods::$img_path.$model->id.'/cimg_'?>"></form-img-container>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php $this->registerJsFile('js/goods/admin_goods.js', ['depends' => \app\assets\AppAssetAdmin::className()])?>
<?php $this->registerJsFile('js/ckeditor_add.js', ['depends' => \app\assets\AppAssetAdmin::className()])?>
