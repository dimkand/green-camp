<?php
/**
 * Created by PhpStorm.
 * User: dk
 * Date: 09.04.19
 * Time: 21:50
 */
use yii\bootstrap\Modal;
use yii\helpers\Url;

//<!-- Modal -->

Modal::begin([
    'header' => "<h3>У Вас в корзине " . Yii::$app->cart->getCount() . " товар(ов)</h3>",
    'id' => 'cart_modal',
]);

?>

<div>
    <button data-dismiss="modal" class="btn btn-success">Продолжить покупки</button>
    <a href="<?= Url::to(['/cart/show'])?>" class="btn btn-primary">Перейти к оформлению заказа</a>
</div>

<?php
Modal::end();
?>