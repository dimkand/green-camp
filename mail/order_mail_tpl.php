<?php

use Yii;

Yii::$app->controller->layout = '@app/mail/layouts/html';
$this->title = 'Заказ №' . $model->id;
?>

<style>
    /*order mail tpl*/
    #order_mail {
        padding: 40px;
        max-width: 1200px;
    }

    #order_mail table td {
        border-bottom: 1px dotted #787878;
    }

    #order_mail table {
        margin-top: 20px;
        width: 100%;
    }

    #order_mail table th, #order_mail table td {
        padding: 3px 5px;
    }

    #order_mail table th {
        background-color: #e6e6e6;
    }

    #order_mail table tr:last-child td {
        font-weight: 700;
    }
</style>

<div id="order_mail">
    <table>
        <tr>
            <th>Номер заказа</th>
            <td><?= $model->id ?></td>
        </tr>
        <tr>
            <th>Способ оплаты</th>
            <td><?= $model->method->title ?></td>
        </tr>
        <tr>
            <th>Имя и фамилия</th>
            <td><?= $model->name ?></td>
        </tr>
        <tr>
            <th>Область</th>
            <td><?= $model->region ?></td>
        </tr>
        <tr>
            <th>Город</th>
            <td><?= $model->town ?></td>
        </tr>
        <tr>
            <th>Отделения "Новой почты" или "Intime"</th>
            <td><?= $model->cell ?></td>
        </tr>
        <tr>
            <th>Адрес</th>
            <td><?= $model->address ?></td>
        </tr>
        <tr>
            <th>Телефон</th>
            <td><?= \app\components\Helpers::parsePhone($model->phone) ?></td>
        </tr>
        <tr>
            <th>Дата создания заказа</th>
            <td><?= Yii::$app->formatter->asDatetime(time(), 'medium') ?></td>
        </tr>
    </table>

    <table>
        <tr>
            <th>Наименование товара</th>
            <th>Цена</th>
            <th>Количество</th>
            <th>Сумма</th>
        </tr>
        <?php $col = $sum = 0 ?>
        <?php foreach ($goods as $good): ?>
            <tr>
                <td><?= $good->title ?></td>
                <td><?= $good->price ?></td>
                <td><?= $good->getQuantity() ?></td>
                <td><?= $good_sum = $good->price * $good->getQuantity() ?></td>
            </tr>
            <?php $col += $good->getQuantity();
            $sum += $good_sum ?>
        <?php endforeach; ?>
        <tr>
            <td>Всего</td>
            <td></td>
            <td><?= $col ?></td>
            <td><?= $sum ?></td>
        </tr>
    </table>
</div>