<?php
use yii\widgets\ActiveForm;
use app\models\Comments;
use yii\helpers\Html;
use kartik\rating\StarRating;

?>
<div id="comments">
    <?php foreach ($comments as $comment):?>
    <div class="comment">
        <div class="comment_name">
            <?= $comment['name']?>
        </div>
        <div class="comment_text">
            <?= $comment['text']?>
        </div>
    </div>
    <?php endforeach;?>
</div>

<div class="comments_create">
    <h4>Добавить отзыв</h4>
<?php $comment_model = new Comments();?>
    <div>

        <?php $form = ActiveForm::begin(['action' => '/comments/create']); ?>

        <?php echo $form->field($comment_model, 'rating')->label('Ваша оценка')->widget(StarRating::classname(), [
            'name' => 'rating_add',
            'pluginOptions' => [
                'showClear' => false,
                'showCaption' => true,
            ]
        ]); ?>

        <?= $form->field($comment_model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($comment_model, 'text')->textarea(['rows' => 6]) ?>

        <?= $form->field($comment_model, 'goods_id')->label(false)->hiddenInput(['value' => $id]) ?>

        <div class="form-group">
            <?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
