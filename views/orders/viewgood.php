<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Goods */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['/orders/editlist']];
$this->params['breadcrumbs'][] = ['label' => 'Заказ №'.$order_id, 'url' => ['/orders/view', 'id' => $order_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Удалить из заказа', ['/orders/deletegood', 'id' => $model->id, 'order_id' => $order_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить товар?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

<?= $this->render('@views/goods/_detail_view', ['model' => $model])?>

</div>