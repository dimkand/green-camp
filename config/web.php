<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'dk',
    'name' => 'Магазин',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'defaultRoute' => 'pages',
    'language' => 'ru-RU',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
        '@dksoft' => '@app/dksoft',
        '@views' => '@app/views'
    ],
    'components' => [
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'defaultTimeZone' => 'Europe/Moscow',
            'timeZone' => 'Europe/Moscow',
            'locale' => 'ua-UA',
            'numberFormatterSymbols' => [
                NumberFormatter::CURRENCY_SYMBOL => '',
            ],
            'nullDisplay' => 0
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'sdsdsdfsfdfgfghfgfdgf',
            'baseUrl' => '',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\Users',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'pages/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning', 'info'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'admin' => 'admin/index',
                '/' => 'pages/index',
                '<alias:\w+>' => 'categories/show',
                't/<alias:\w+>' => 'goods/show',
                'goods/editlist/<alias:\w+>' => 'goods/editlist',
            ],
        ],
        'cart' => [
            'class' => 'yii2mod\cart\Cart',
            // you can change default storage class as following:
            'storageClass' => [
                'class' => 'yii2mod\cart\storage\SessionStorage'
            ]
        ],
        'view' => [
            'class' => '\rmrevin\yii\minify\View',
            'enableMinify' => !YII_ENV_DEV,
            'concatCss' => true, // concatenate css
            'minifyCss' => true, // minificate css
            'concatJs' => true, // concatenate js
            'minifyJs' => true, // minificate js
            'minifyOutput' => true, // minificate result html page
            'webPath' => '@web', // path alias to web base
            'basePath' => '@webroot', // path alias to web base
            'minifyPath' => '@webroot/minify', // path alias to save minify result
            'jsPosition' => [\yii\web\View::POS_END], // positions of js files to be minified
            'forceCharset' => 'UTF-8', // charset forcibly assign, otherwise will use all of the files found charset
            'expandImports' => true, // whether to change @import on content
            'compressOptions' => ['extra' => true], // options for compress
            'excludeFiles' => [
                'jquery.js',
                'ckeditor.js',
            ],
//            'excludeBundles' => [
//                \app\helloworld\AssetBundle::class, // exclude this bundle from minification
//            ],
        ],
        'assetManager' => [
            'linkAssets' => true
//            'bundles' => require __DIR__ . '/' . (YII_ENV_PROD ? 'assets-prod.php' : 'assets-dev.php'),
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
        'generators' => [ // здесь
            'crud' => [ // название генератора
                'class' => 'app\templates\generators\crud\Generator', // класс генератора
                'templates' => [ // настройки сторонних шаблонов
                    'dkDefault' => '@app/templates/generators/crud/default', // имя_шаблона => путь_к_шаблону
                    'dkImg' => '@app/templates/generators/crud/img'
                ]
            ],
            'model' => [ // название генератора
                'class' => 'app\templates\generators\model\Generator', // класс генератора
                'templates' => [ // настройки сторонних шаблонов
                    'dkDefault' => '@app/templates/generators/model/default', // имя_шаблона => путь_к_шаблону
                    'dkImg' => '@app/templates/generators/model/img'
                ]
            ]
        ],
    ];
}

return $config;
