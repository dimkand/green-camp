<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

/* @var $model \yii\db\ActiveRecord */
$model = new $generator->modelClass();
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
    $safeAttributes = $model->attributes();
}

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-form">

    <?= "<?php " ?>$form = ActiveForm::begin(); ?>

<?php foreach ($generator->getColumnNames() as $attribute) {
    if (in_array($attribute, $safeAttributes)) {
        $tableSchema = $generator->getTableSchema();
        $column = $tableSchema->columns[$attribute];
        if(strripos($column->name, 'img') !== false) { ?>
    <div><label for="croppic_div_a">Картинка</label></div>
    <div>
        <div id="croppic_div_a"></div>
        <p class="validation_errors"></p>
    </div>
    <input type="hidden" id="cimg" name='cimg'>
    <input type="hidden" name="old_img" value="<?= "<?= ";?>$model->img;<?= "?>";?>">

     <?php } else
            echo "    <?= " . $generator->generateActiveField($attribute) . " ?>\n\n";
    }
}?>
    <div class="form-group">
        <?= "<?= " ?>Html::submitButton(<?= $generator->generateString('Сохранить') ?>, ['class' => 'btn btn-success']) ?>
    </div>

    <?= "<?php " ?>ActiveForm::end(); ?>

</div>

<?= "<?php\n"?>
$this->registerJsFile('js/ckeditor_add.js', ['depends' => \app\assets\AppAssetAdmin::className()]);
$this->registerJsFile('js/croppic/addCroppic.js', ['depends' => \yii\web\JqueryAsset::className()]);
$this->registerJs("addCroppic('".yii\helpers\Url::base(true)."', 'croppic_div_a', 'cimg', '".$model->img."')");
<?= "?>"?>
