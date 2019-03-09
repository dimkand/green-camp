<?php

use yii\helpers\Url;

/* @var $this yii\web\View */

$this->registerMetaTag(['name' => 'description', 'content' => $model->description]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $model->keywords]);

$this->title = $model->title;
?>
    <h1><?= $model->description ?></h1>
    <div id="line_1" class="line"></div>
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
    <div id="line_2" class="line"></div>
    <div id="main_text"><?= $model->text ?></div>
    <div id="line_4" class="line"></div>

    <section id="main_articles">
        <h2>Статьи</h2>
        <div id="articles_list">
            <?= $this->render('@views/articles/articles', ['articles' => $articles]); ?>
        </div>
    </section>

    <div class="button_wrap">
        <a class="button" href="<?= Url::base(true) . '/categories/show' ?>">В магазин</a>
    </div>

<?php $this->registerJsFile(YII_ENV_DEV ? 'js/pages/index.js':'js/pages/index.min.js', ['depends' => \app\assets\AppAsset::className()]);