<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "params".
 *
 * @property int $id
 * @property string $tel1
 * @property string $tel2
 */
class Params extends Crud
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'params';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tel1', 'tel2'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
    'id' => 'ID',
    'tel1' => 'Телефон 1',
    'tel2' => 'Телефон 2',
        ];
    }
}
