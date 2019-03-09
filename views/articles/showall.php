<?= $this->render('@views/metatags', ['model' => $model]);?>

<div id="articles">
    <h1>Все статьи</h1>
    <div id="articles_list">
        <?= $this->render('@views/articles/articles', ['articles' => $models, 'page' => $page]); ?>
    </div>
</div>

<?php
$this->registerJsFile('js/articles/articlesAjaxLoad.js', ['depends' => \app\assets\AppAsset::className()]);
$this->registerJsFile('js/articles/showAll.js', ['depends' => \app\assets\AppAsset::className()]);