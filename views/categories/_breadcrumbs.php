<?php

$breadcrumbs = array();
while ($id != 0){
    $category = \app\models\Categories::findOne($id);
    if(isset($no_url) && $no_url)
        $breadcrumbs[] = ['label' => $category->title];
    else
        $breadcrumbs[] = ['label' => $category->title, 'url' => [$route, 'id' => $category->id]];
    $id = $category->parent;
}
$breadcrumbs = array_reverse($breadcrumbs);
$this->params['breadcrumbs'] = array_merge($this->params['breadcrumbs'], $breadcrumbs);
unset($this->params['breadcrumbs'][count($this->params['breadcrumbs']) - 1]['url']);