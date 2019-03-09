<?php

use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $gridOptions array */

?>
<?php Pjax::begin(['timeout' => 5000, 'id' => 'pjax-cart-container']); ?>
<?php echo GridView::widget($gridOptions); ?>
<?php if((Yii::$app->cart->getCount() != 0))
echo Html::a('Оформить заказ', '/orders/create', ['id' => 'create_order', 'class' => 'btn btn-primary']);?>
<?php Pjax::end(); ?>