<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property string $name
 * @property string $address
 * @property string $tel
 * @property string $date
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date'], 'safe'],
            [['name', 'country', 'region', 'method', 'town', 'address', 'phone'], 'required'],
            [['name'], 'string', 'max' => 120],
            [['address'], 'string', 'max' => 255],
            [['phone'], 'match', 'pattern' => '/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/', 'message' => 'Неправельный формат номера телефона'],
        ];
    }

    public function getGoods()
    {
        return $this->hasMany(OrdersGoods::className(), ['orders_id' => 'id']);
    }

    public function getMethod()
    {
        return $this->hasOne(Methods::className(), ['id' => 'method_id']);
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        if (!parent::save($runValidation, $attributeNames))
            return false;

        if (!$this->getIsNewRecord())
            OrdersGoods::deleteAll(['orders_id' => $this->id]);

        $goods = Yii::$app->cart->getItems();
        $data = [];
        foreach ($goods as $good) {
            $data[] = [$this->id, $good->id, $good->getQuantity()];
        }
        Yii::$app->db->createCommand()->batchInsert(OrdersGoods::tableName(), ['orders_id', 'goods_id', 'goods_count'], $data)->execute();
        Yii::$app->cart->clear();
        return $goods;
    }

    public function delete()
    {
        OrdersGoods::deleteAll(['orders_id' => $this->id]);
        return parent::delete();
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'country' => 'Страна',
            'region' => 'Область',
            'town' => 'Город',
            'address' => 'Адрес',
            'method_id' => 'Способ оплаты',
            'phone' => 'Телефон',
            'date' => 'Дата',
        ];
    }

}
