<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\components\Helpers;

/* @var $this yii\web\View */
/* @var $model app\models\Goods */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['editlist']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id, 'category_id' => $category_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id, 'category_id' => $category_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить товар?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= $this->render('_detail_view', ['model' => $model])?>

</div>
