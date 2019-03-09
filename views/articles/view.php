<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Articles */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Статьи', 'url' => ['editlist']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="articles-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить статью?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            'description',
            'keywords',
            'author',
            [
                'attribute'=>'text',
                'format' => 'html',
                'value'=>($model->text)
            ],
            [
                'attribute'=>'img',
                'format' => 'html',
                'value'=>("<img src='".\yii\helpers\Url::base(true).'/'.$model->img."' class='widget_img'>")
            ],
            [
                'attribute' => 'date',
                'format' => ['datetime', 'medium']
            ],
        ],
    ]) ?>

</div>
