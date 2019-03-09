<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pages".
 *
 * @property string $id
 * @property string $title
 * @property string $description
 * @property string $keywords
 * @property string $text
 */
class Pages extends \app\models\Crud
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['text'], 'string'],
            [['id'], 'string', 'max' => 40],
            [['title'], 'string', 'max' => 80],
            [['description', 'keywords'], 'string', 'max' => 255],
            [['id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название страницы',
            'description' => 'Описание страницы',
            'keywords' => 'Ключевые слова',
            'text' => 'Текст',
        ];
    }
}
