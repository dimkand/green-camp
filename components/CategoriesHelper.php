<?php

namespace app\components;

use app\models\Categories;
use yii\helpers\ArrayHelper;
use \app\models\CTypes;

class CategoriesHelper
{
    public static $CATEGORIES_FLAG = 1;
    public static $CHARS_FLAG = 2;

    public static function createItems($items, $flag = false, $path = '', $id = 0, &$conteiner = array())
    {
        foreach ($items as $item) {
            if($flag == self::$CATEGORIES_FLAG && $item->type != 1 && $item->type != 2)
                continue;
            if($flag == self::$CHARS_FLAG && $item->type != 3 && $item->type != 4)
                continue;
            if ($item->parent == $id) {
                self::createItem($conteiner, $item, $path);
                self::createItems($items, $flag, $path, $item->id, $conteiner['items'][count($conteiner['items']) - 1]);
            }
        }
        return $conteiner;
    }

    private static function createItem(&$conteiner, $item, $path)
    {
        //$path_id = empty($item->id) ? '' : '?' . 'id=' . $item->id;
        $path_id = $item->alias;

        $conteiner['items'][] = ['label' => $item->title, 'url' => $path . $path_id, 'id' => $item->id, 'type' => $item->type];
    }

    public static function typePermission($model)
    {
        if(!$model->getIsNewRecord())
            if(Categories::findOne(['parent' => $model->id]))
                return false;
        return true;
    }

    public static function getTypes($parent_id)
    {
        $condition = ['in', 'id', [1, 2]];
        if ($parent_id != 0) {
            $type = Categories::findOne($parent_id)->type;
            if ($type == 1)
                $condition = ['in', 'id', [1, 2]];
            if ($type == 2)
                $condition = ['id' => 3];
            if ($type == 3)
                $condition = ['id' => 4];
        }
        return ArrayHelper::map(CTypes::find()->where($condition)->asArray()->all(), 'id', 'title');
    }
}