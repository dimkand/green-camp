<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "categoriestypes".
 *
 * @property int $id
 * @property string $title
 */
class CTypes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ctypes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 80],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
    'id' => 'ID',
    'title' => 'Название',
        ];
    }
}
