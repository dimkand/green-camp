<?php

use yii2mod\slider\IonSlider;
use yii\helpers\ArrayHelper;

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
                                <?php
                                $price = explode(';', Yii::$app->request->get('slider'));
                                $priceMin = ArrayHelper::getValue($price, 0);
                                $priceMax = ArrayHelper::getValue($price, 1);
                                ?>
                                <?= IonSlider::widget([
                                    'name' => 'slider',
                                    'type' => IonSlider::TYPE_DOUBLE,
                                    'pluginOptions' => [
                                        'min' => 0,
                                        'max' => 15000,
                                        'from' => $priceMin ?? 0,
                                        'to' => $priceMax ?? 15000,
                                        'step' => 1,
//                                        'hide_min_max' => true,
//                                        'hide_from_to' => true
                                        'onFinish' => new \yii\web\JsExpression('() => filter.getContent()')
                                    ],
                                ]);?>
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

<?php $this->registerJsFile('js/categories/categories.js', ['depends' => \app\assets\AppAsset::className()]);?>
<?php $this->registerJsFile('js/dk_filter.js');?>
<?php $this->registerJs('filter.run()', \yii\web\View::POS_READY);?>