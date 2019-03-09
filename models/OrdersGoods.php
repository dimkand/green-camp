<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orders_goods".
 *
 * @property int $id
 * @property int $orders_id
 * @property int $goods_id
 * @property int $goods_count
 */
class OrdersGoods extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders_goods';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['orders_id', 'goods_id', 'goods_count'], 'required', 'integer']
        ];
    }

    public function getGoods()
    {
        return $this->hasOne(Goods::className(), ['id' => 'goods_id']);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'orders_id' => 'Orders ID',
            'goods_id' => 'Goods ID',
            'goods_count' => 'Goods Count',
        ];
    }

}
