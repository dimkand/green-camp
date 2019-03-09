<?php

use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model app\models\Categories */

$this->title = 'Создание категории';
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['editlist']];
$this->render('_breadcrumbs', ['id' => $model->parent, 'route' => 'editlist']);
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categories-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<script src="<?= Url::base(true)?>/js/croppic/addCroppic.js"></script>
<script>
    window.addEventListener('DOMContentLoaded', function(){
        addCroppic("<?= Url::base(true)?>", 'croppic_div_c', 'cimg');
    });
</script>
