<?php
$this->title = $model->title;
$this->params['breadcrumbs'][] = $this->title;
?>


<?= $model->text?>

<?php $this->registerJsFile('js/pages/cart.js', ['depends' => \app\assets\AppAsset::className()]);
