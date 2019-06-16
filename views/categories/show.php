<?php

use yii\helpers\Url;
use kartik\slider\Slider;

if (empty($model)) {
    $this->title = 'Каталог';
    $this->params['breadcrumbs'][] = $this->title;
} else {
    $this->title = $model->title;
    echo $this->render('@views/metatags', ['model' => $model]);
    $this->params['breadcrumbs'] = [];
    $this->render('_breadcrumbs', ['id' => $model->id, 'route' => 'show']);
}

echo $this->render('@views/cart/modal.php');

?>
    <div id="wrapper">
        <div id="leftblock">
            <?php
            echo \dksoft\widgets\SideNav::widget([
                'header' => 'Каталог',
                'items' => isset($categories['items']) ? $categories['items'] : []
            ]);
            ?>

            <?php if (!empty($chars['items'])): ?>
                <div id="dk_filter">
                    <form>

                        <div id="dk_filter_slider">
                            <span>Цена:</span>
                            <div class="slider-wrap">
                                <?=
                                Slider::widget([
                                    'name'=>'price',
                                    'value'=>'0,10000',
                                    'sliderColor'=>Slider::TYPE_SUCCESS,
                                    'handleColor'=>Slider::TYPE_SUCCESS,
                                    'pluginOptions'=>[
                                        'min'=>0,
                                        'max'=>10000,
                                        'step'=>5,
                                        'range'=>true
                                    ],
                                ])?>
                            </div>
                            <div class="dk_filter_slider_badge">
                                <b class="badge">0</b>
                                <b class="badge">10 000</b>
                            </div>
                        </div>

                        <input class="dk_filter_alias" type="hidden" name="alias" value="">
                        <ul class="nav nav-pills nav-stacked">
                            <?php foreach ($chars['items'] as $char): ?>
                                <li>
                                    <a href="#"><?= $char['label'] ?><span
                                                class='indicator glyphicon glyphicon-chevron-right'></span></a>
                                    <?php if (isset($char['items'])): ?>
                                        <ul class="dk_filter_values">
                                            <?php foreach ($char['items'] as $value): ?>
                                                <li>
                                                    <label>
                                                        <input type="checkbox"
                                                               name="value_<?= $value['id'] ?>"
                                                               value="<?= $value['id'] ?>"><?= $value['label'] ?>
                                                    </label>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <div id="dk_filter_window">
                            <button type="submit" href="#" class="btn btn-success">Применить</button>
                            <a id="dk_filter_reset" href="#" title="Сбросить"><span
                                        class="glyphicon glyphicon-remove-circle"></span></a>
                        </div>
                    </form>
                </div>
            <?php endif; ?>
        </div>

        <div id="goods_wrapper">
            <h1><?= $this->title?></h1>
            <?= $this->render(!isset($model->type) || $model->type == 1 ? 'categories_show' : 'goods_show', [
                'data' => $data,
                'pages' => $pages,
            ]); ?>
        </div>
    </div>

    <script src="<?= Url::base(true) ?>/js/dk_filter.js"></script>
    <script>
        window.addEventListener('DOMContentLoaded', function () {
            filterRun("<?= Url::base(true)?>");
        });
    </script>

<?php $this->registerJsFile('js/categories/categories.js', ['depends' => \app\assets\AppAsset::className()]);