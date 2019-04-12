<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAssetAdmin;

AppAssetAdmin::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-fixed-top navbar-green',
        ],
    ]);
    $controller = Yii::$app->controller->id;
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Админ панель', 'url' => ['/admin/index']],
            ['label' => 'Страницы', 'url' => ['/pages/editlist'], 'active' => $controller == 'pages'],
            ['label' => 'Статьи', 'url' => ['/articles/editlist'], 'active' => $controller == 'articles'],
            ['label' => 'Категории', 'url' => ['/categories/editlist'], 'active' => $controller == 'categories'],
            ['label' => 'Товары', 'url' => ['/goods/editlist'], 'active' => $controller == 'goods'],
            ['label' => 'Отзывы', 'url' => ['/comments/editlist'], 'active' => $controller == 'comments'],
            ['label' => 'Заказы', 'url' => ['/orders/editlist'], 'active' => $controller == 'orders'],
            ['label' => 'Методы доставки', 'url' => ['/methods/editlist'], 'active' => $controller == 'methods'],
            ['label' => 'Телефоны', 'url' => ['/params/editlist'], 'active' => $controller == 'params'],
            ['label' => 'Настройки', 'url' => ['/prefs/update'], 'active' => $controller == 'prefs'],
                '<li>'
                . Html::beginForm(['/admin/logout'], 'post')
                . Html::submitButton(
                    'Выход (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'homeLink' => [
                'label' => 'Админ панель',
                'url' => '@web/admin'
            ]
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
