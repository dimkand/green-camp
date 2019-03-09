<?php
echo $this->render('@views/metatags', ['model' => $model]);
?>

<div id="in_article">
    <h1><?= $model->title ?></h1>
    <div id="in_article_date"><?= Yii::$app->formatter->asDate($model->date, 'long') ?></div>
    <div id="in_article_text"><?= $model->text ?></div>
    <div id="in_article_author"><?= $model->author ?></div>
    <div class="button_wrap">
        <a class="button" href="<?= \yii\helpers\Url::base(true) ?>/articles/showall">Еще статьи</a>
    </div>
</div>

<?php $this->registerJsFile('js/articles/show.js', ['depends' => \app\assets\AppAsset::className()]);