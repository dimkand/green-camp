<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\assets\FontAsset;
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
use app\components\Helpers;

AppAsset::register($this);
FontAsset::register($this);

$tels = \app\models\Params::find()->one();
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
<script>
    var bodies = document.getElementsByTagName('body');
    for (i = 0; i < bodies.length; i++) {
        bodies[i].classList.add('hide');
    }
</script>
<?php $this->beginBody() ?>

<div class="wrap">
    <header>
        <?php
        NavBar::begin([
            'brandLabel' => "<div>" . Helpers::parsePhone($tels['tel1']) . "</div>" . "<div>" . Helpers::parsePhone($tels['tel2']) . "</div>",
            'options' => [
                'class' => 'navbar navbar-fixed-top main_menu',
            ],
        ]);
        $controller = Yii::$app->controller->id;
        $action = Yii::$app->controller->action->id;
        echo Nav::widget([
            'encodeLabels' => false,
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                ['label' => '<span class="glyphicon glyphicon-home"></span><span class="navbar-li-text">Главная</span>', 'url' => ['/'], 'active' => $action == 'index'],
                ['label' => '<span class="glyphicon glyphicon-briefcase"></span><span class="navbar-li-text">Каталог</span>', 'url' => ['/categories/show'], 'active' => ($controller == 'categories') || ($controller == 'goods')],
                ['label' => '<span class="glyphicon glyphicon-file"></span><span class="navbar-li-text">Статьи</span>', 'url' => ['/articles/showall'], 'active' => $controller == 'articles'],
                ['label' => '<span class="glyphicon glyphicon-envelope"></span><span class="navbar-li-text">Контакты</span>', 'url' => ['/pages/contacts'], 'active' => $action == 'contacts'],
            ],
        ]);
        NavBar::end();
        ?>
    </header>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'homeLink' => [
                'label' => 'Главная',
                'url' => '@web/'
            ]
        ]) ?>
        <?= Alert::widget() ?>

        <div id="cart">
            <div id="cart_count"><span><?= Yii::$app->cart->getCount() ?></span></div>
            <a href="/cart/show"><span class="glyphicon glyphicon-shopping-cart"></span></a>
        </div>

        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; green-camp.com.ua <?= date('Y') ?></p>
    </div>
</footer>

<!-- Begin LeadBack code {literal}-->
<!--<script>-->
<!--    var _emv = _emv || [];-->
<!--    _emv['campaign'] = 'ed1dac006b5ef635cd7a1a6e';-->
<!---->
<!--    (function () {-->
<!--        var em = document.createElement('script');-->
<!--        em.type = 'text/javascript';-->
<!--        em.async = true;-->
<!--        em.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'leadback.ru/js/leadback.js';-->
<!--        var s = document.getElementsByTagName('script')[0];-->
<!--        s.parentNode.insertBefore(em, s);-->
<!--    })();-->
<!--</script>-->
<!-- End LeadBack code {/literal}-->


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
