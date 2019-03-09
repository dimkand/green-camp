<?php
$this->title = 'Корзина';
$this->params['breadcrumbs'][] = $this->title;
?>

<a id="clear_cart" class="btn btn-success" href="/cart/clear">Очистить корзину</a>

    <?= \yii2mod\cart\widgets\MyCartGrid::widget();?>

<?php $this->registerJsFile('js/pages/cart.js', ['depends' => \app\assets\AppAsset::className()]);
