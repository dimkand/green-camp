<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "methods".
 *
 * @property int $id
 * @property string $title
 * @property string $text
 */
class Methods extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'methods';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text'], 'required'],
            [['text'], 'string'],
            [['title'], 'string', 'max' => 30],
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
    'text' => 'Текст',
        ];
    }

}
