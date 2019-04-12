<?php

use yii\helpers\Url;

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