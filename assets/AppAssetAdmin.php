<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAssetAdmin extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'js/croppic/css/croppic.css',
        'css/all_styles.css',
        'css/admin_styles.css',
        'css/icomoon_style.css',
        'css/bootstrap_addons/navbar_green.css',
        'css/bootstrap_addons/sidebar_left.css',
    ];
    public $js = [
        'js/vue.js',
        'js/croppic/js/croppic.js',
        'js/croppic/js/addCroppic.js',
        'js/ckeditor/ckeditor.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
