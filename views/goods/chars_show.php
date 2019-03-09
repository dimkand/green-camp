<?php
?>

<div id="chars_show">
    <ul>
        <?php foreach ($models as $model): ?>
        <?php if($model->type != 4){
            continue;
            }?>

            <li class="chars_values">
                <div><?= $model->getParent()->title ?></div>
                <div><?= $model->title ?></div>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
