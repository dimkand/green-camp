<?php
/**
 * Created by PhpStorm.
 * User: dk
 * Date: 09.04.19
 * Time: 21:50
 */

use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\Pjax;

//<!-- Modal -->
Modal::begin([
    'header' => "<h3>У Вас в корзине есть товары</h3>",
    'id' => 'cart_modal',
]);
?>

    <div>
        <button data-dismiss="modal" class="btn btn-success">Продолжить покупки</button>
        <a href="<?= Url::to(['/cart/show']) ?>" class="btn btn-primary">Перейти к оформлению заказа</a>
    </div>

<?php
Modal::end();
?>