<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Articles */

$this->title = 'Редактирование статьи';
$this->params['breadcrumbs'][] = ['label' => 'Статьи', 'url' => ['editlist']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="articles-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<script src="<?= Url::base(true)?>/js/croppic/addCroppic.js"></script>
<script>
    window.addEventListener('DOMContentLoaded', function(){
        addCroppic("<?= Url::base(true)?>", 'croppic_div_a', 'cimg', "<?= $model->img?>");
    });
</script>
