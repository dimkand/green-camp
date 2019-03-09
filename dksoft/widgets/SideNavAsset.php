<?php

namespace dksoft\widgets;

use yii\web\AssetBundle;

/**
 * The asset bundle for the [[SideNav]] widget.
 *
 * @author DK <koryak.dima@bk.ru>
 */
class SideNavAsset extends AssetBundle
{
    public $sourcePath = '@dksoft/widgets/assets';
    public $js = [
        'js/sideNav.js',
    ];
    public $css = [
        'css/sideNav.css',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset'
    ];
}