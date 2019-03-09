<?php

namespace yii2mod\cart\widgets;

use yii\web\AssetBundle;

class MyCartGridAsset extends AssetBundle
{
    public $sourcePath = '@vendor/yii2mod/yii2-cart/assets';
    public $css = [
        'css/myCart.css'
    ];
    public $js = [
        'js/myCart.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset'
    ];
}