<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div id="goods_show">
<?php foreach ($data as $good):?>
    <div class="good_show">
        <a class="good_show_a" href="<?= Url::toRoute(['goods/show', 'id' => $good['id']]); ?>"></a>
        <div class="good_show_articul">Артикул <?= $good['id']?></div>
        <div class="good_show_img">
            <img src="<?= Url::base(true) . '/' . \app\models\Goods::$img_path . $good['id'] ?>/cimg_0.jpeg" alt="<?= $good['title']?>">
        </div>
        <?= \kartik\rating\StarRating::widget([
            'name' => 'rating',
            'value' => $good['rating'],
            'pluginOptions' => [
                'disabled' => true,
                'showClear' => false,
                'theme' => 'krajee-uni',
                'size' => 'sm',
                'showCaption' => false,
            ]
        ]);?>
        <?php
        ?>
        <div class="good_show_title"><?= $good['title'] ?></div>
        <div class="good_show_wr">
            <div class="good_show_price">
                <?= Yii::$app->formatter->asCurrency($good['price']) ?>
            </div>
            <div class="good_show_cart">
                <?= Html::a("<span class='glyphicon glyphicon-shopping-cart'></span>", ['#'], ['data-attr' => $good['id'], 'title' => 'Добавить в корзину']) ?>
            </div>
        </div>
    </div>
<?php endforeach;?>
</div>

<?php
if(isset($pages))
    echo \yii\widgets\LinkPager::widget(['pagination' => $pages, 'options' => ['class' => 'pagination ajax_pagination']]);
?>
