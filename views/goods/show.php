<?php

use kv4nt\owlcarousel\OwlCarouselWidget;
use yii\helpers\Url;
use app\models\Goods;
use yii\bootstrap\Tabs;
use kartik\rating\StarRating;

echo $this->render('@views/metatags', ['model' => $model]);

$this->params['breadcrumbs'][] = ['label' => 'Каталог', 'url' => ['/categories/show']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div id="good_card">
    <h1><?= $model->title?></h1>
    <div>
        <div id="good_card_crsl">
            <?php
            OwlCarouselWidget::begin([
                'container' => 'div',
                'pluginOptions' => [
                    'autoplay' => true,
                    'autoplayTimeout' => 6000,
                    'items' => 3,
                ]
            ]);
            ?>

            <?php for ($i = 0; $i < $model->img_count; $i++): ?>
                <div class="good_card_img">
                    <a href="<?= Url::base(true) . '/' . Goods::$img_path . $model->id . '/img_'.$i.'.jpeg' ?>"></a>
                    <img src="<?= Url::base(true) . '/' . Goods::$img_path . $model->id . '/cimg_'.$i.'.jpeg' ?>" alt="<?= $model->title?>">
                </div>
            <?php endfor; ?>

            <?php OwlCarouselWidget::end(); ?>
        </div>
        <div>
            <div id="good_card_price">
                <span>Артикул <?= $model['id']?></span>
                <div>
                    <?= Yii::$app->formatter->asCurrency($model->price) . ' грн.' ?>
                </div>
                <a id="good_card_cart" class="btn btn-success" href="#" data-attr='<?= $model->id ?>'>Добавить в
                    корзину</a>
                <a id="good_card_lower" href="#">Нашли дешевле? Снизим цену!</a>
            </div>
            <?php echo StarRating::widget([
                'name' => 'rating',
                'value' => $model->rating,
                'pluginOptions' => ['disabled'=>true, 'showClear'=>false]
            ]);?>
        </div>
    </div>
    <div id="good_card_tabs">
        <?=
        Tabs::widget([
            'items' => [
                [
                    'label' => 'Описание',
                    'content' => $model->text,
                ],
                [
                    'label' => 'Характеристики',
                    'content' => $this->render('chars_show', ['models' => $model->getCategories()->all()]),
                ],
                [
                    'label' => 'Отзывы',
                    'content' => $this->render('@views/comments/create', ['comments' => $model->comments, 'id' => $model->id]),
                ],
            ]
        ]);
        ?>
    </div>
</div>

<?php
$this->registerCssFile('/js/lightbox/magnific-popup.css');
$this->registerJsFile('/js/lightbox/jquery.magnific-popup.min.js', ['depends' => \app\assets\AppAsset::className()]);
?>

<script>
    window.addEventListener('DOMContentLoaded', function(){
        // lightbox для фото
        $('#good_card_crsl').magnificPopup({
            delegate: 'a',
            type: 'image',
            tLoading: 'Загрузка изображения #%curr%...',
            mainClass: 'mfp-with-zoom',
            zoom: {
                enabled: true, // By default it's false, so don't forget to enable it
                duration: 300, // duration of the effect, in milliseconds
                easing: 'ease-in-out', // CSS transition easing function
                opener: function(openerElement) {
                    var img = openerElement.next();
                    return img;
                }
            },
            gallery: {
                enabled: true,
                navigateByImgClick: true,
                preload: [0,1] // Will preload 0 - before current, and 1 after the current image
            },
            image: {
                tError: '<a href="%url%">The image #%curr%</a> не могу загрузить.',
                titleSrc: function(item) {
                    var title = $(item.el[0]).next().attr('alt');
                    return title;
                }
            }
        });
    });
</script>