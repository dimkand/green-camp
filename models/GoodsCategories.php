<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "goods_categories".
 *
 * @property int $id
 * @property int $goods_id
 * @property int $category_id
 */
class GoodsCategories extends Crud
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goods_categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goods_id', 'category_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
    'id' => 'ID',
    'goods_id' => 'Goods ID',
    'category_id' => 'Category ID',
        ];
    }
}
