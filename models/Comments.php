<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comments".
 *
 * @property int $id
 * @property string $name
 * @property string $text
 * @property int $goods_id
 */
class Comments extends \yii\db\ActiveRecord
{
    public $rating;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text', 'name'], 'required'],
            [['text'], 'string'],
            [['goods_id'], 'integer'],
            [['name'], 'string', 'max' => 20],
            [['rating'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
    'id' => 'ID',
    'name' => 'Имя',
    'text' => 'Текст',
    'goods_id' => 'Goods ID',
        ];
    }

}
