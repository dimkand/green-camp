<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
    <div id="main_categories_container">
        <?php foreach ($data as $category): ?>
            <figure class="category ccat effect-lily">
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
<?= \yii\widgets\LinkPager::widget(['pagination' => $pages, 'options' => ['class' => 'pagination ajax_pagination']])?>