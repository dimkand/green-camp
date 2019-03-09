<?php

namespace yii2mod\cart\widgets;

use kartik\field\FieldRange;
use kartik\form\ActiveForm;
use kartik\spinner\Spinner;
use Yii;

class MyCartGrid extends CartGrid
{
    public function init()
    {
        parent::init();
        MyCartGridAsset::register($this->getView());

        $this->gridOptions = ['columns' =>
            [
                [
                    'attribute' => 'title',
                    'label' => 'Товар',
                    'footer' => '<b>Всего</b>'
                ],
                [
                    'attribute' => 'price',
                    'format' => 'currency',
                    'label' => 'Цена'
                ],
                [
                    'attribute' => 'quantity',
                    'label' => 'Количество',
                    'format' => 'text',
                    'contentOptions' => ['class' => 'td_quantity'],
                    'content' => function ($model) {
                        $value = Yii::$app->cart->getAttributeTotalById('quantity', $model->id);
                        $data = "<div class='quantity_div'><a class='quantity_prev' href='#'><span class='glyphicon glyphicon-triangle-left'></span></a>";
                        $data .= "<span class='hidden'>$model->id</span>";
                        $data .= "<input class='quantity_input form-control' type='text' name='quantity' maxlength='4' value='$value'>";
                        $data .= "<a class='quantity_next' href='#'><span class='glyphicon glyphicon-triangle-right'></span></a></div>";
                        return $data;
                    },
                    'footer' => Yii::$app->cart->getCount()
                ],
                [
                    'attribute' => 'Сумма',
                    'format' => 'text',
                    'contentOptions' => ['class' => 'td_sum'],
                    'content' => function ($model) {
                        $data = Yii::$app->formatter->asCurrency(Yii::$app->cart->getAttributeTotalById('price', $model->id));
                        $data .= "<a class='cart_goors_delete' data-id = '$model->id' href='#' title='Удалить товар'><span class='glyphicon glyphicon-trash'><span></a>";
                        return $data;
                    },
                    'footer' => Yii::$app->formatter->asCurrency(Yii::$app->cart->getAttributeTotal('price'))
                ]
            ],
            'showFooter' => true,
            'emptyText' => 'Ваша корзина пуста'
        ];
    }

    public function run()
    {
        return parent::run();
    }
}