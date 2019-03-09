<?php
use \yii\helpers\Url;
use app\components\Helpers;

foreach($articles as $key => $article):?>
    <div class="article">
        <div class="article_subtext" <?= Helpers::displayHelper($key)?>>
            <div class="article_title"><?= $article['title']?></div>
            <p><?= Helpers::substrHelper(strip_tags($article['text']), 1220);?></p>
        </div>
        <a class="article_a" href="<?= Url::toRoute(['articles/show', 'id' => $article['id']])?>"></a>
        <div class="article_prev effect-sidelily">
            <img src="<?= Url::base(true).'/'.$article['img']?>" alt="<?= $article['title']?>">
        </div>
        <div class="article_subtext" <?= Helpers::displayHelper($key, true)?>>
            <div class="article_title"><?= $article['title']?></div>
            <p><?= Helpers::substrHelper(strip_tags($article['text']), 1220);?></p>
        </div>
    </div>
<?php endforeach;

if(isset($page)):?>
    <span class="article_page hidden"><?= $page?></span>
<?php endif;?>
