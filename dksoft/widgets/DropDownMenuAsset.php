<?php

namespace dksoft\widgets;

use yii\web\AssetBundle;

/**
 * The asset bundle for the [[DropDownMenu]] widget.
 *
 * @author DK <koryak.dima@bk.ru>
 */
class DropDownMenuAsset extends AssetBundle
{
    public $sourcePath = '@dksoft/widgets/assets';
    public $js = [
        'js/dropDownMenu.js',
    ];
    public $css = [
        'css/dropDownMenu.css',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}