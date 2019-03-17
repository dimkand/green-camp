<?php

use yii\helpers\Url;

/* @var $this yii\web\View */

$this->registerMetaTag(['name' => 'description', 'content' => $model['main']->description]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $model['main']->keywords]);

$this->title = $model['main']->title;
?>
    <h1><?= $model['main']->description ?></h1>
    <div id="js-line_1" class="line"></div>
    <section id="main_categories">
        <h2>Категории</h2>
        <div id="main_categories_container">
            <?php foreach ($categories as $category): ?>
                <figure class="category cmain effect-lily">
                    <a class="category_a" href="<?= Url::toRoute(['categories/show', 'id' => $category->id]) ?>"></a>
                    <div>
                        <img class="foto_img" src="<?= Url::base(true) . '/' . $category->img; ?>"
                             alt="<?= $category->title ?>">
                    </div>
                    <figcaption>
                        <p><?= $category->title ?></p>
                        <a class="in_detail" href="<?= Url::toRoute(['categories/show', 'id' => $category->id]) ?>">Подробнее</a>
                    </figcaption>
                </figure>
            <?php endforeach; ?>
        </div>
    </section>

    <section id="history">
        <h2><?= $model['history']->title?></h2>
        <div>
            <?= $model['history']->text; ?>
        </div>
    </section>

    <div id="js-line_3" class="line"></div>

    <section id="why_us">
        <h2><?= $model['why_us']->title?></h2>
        <div>
            <?= $model['why_us']->text; ?>
        </div>
    </section>

    <section id="popular_goods">
        <h2>Популярные товары в этом году</h2>
        <div>
            <?= $this->render('@views/categories/goods_show', ['data' => $goods])?>
        </div>
    </section>

    <div id="js-line_5" class="line"></div>

    <section id="info">
        <h2><?= $model['info']->title?></h2>
        <div>
            <?= $model['info']->text; ?>
        </div>
    </section>

<!--    <section id="main_articles">-->
<!--        <h2>Статьи</h2>-->
<!--        <div id="articles_list">-->
    <!--  $this->render('@views/articles/articles', ['articles' => $articles]);
    <!--        </div>-->
<!--    </section>-->

    <div class="button_wrap">
        <a class="button" href="<?= Url::base(true) . '/categories/show' ?>">В магазин</a>
    </div>

<?php $this->registerJsFile(YII_ENV_DEV ? 'js/pages/index.js' : 'js/pages/index.min.js', ['depends' => \app\assets\AppAsset::className()]);