<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "articles".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $keywords
 * @property string $author
 * @property string $text
 * @property string $img
 * @property string $date
 */
class Articles extends Crud
{
    // путь к изображениям статей
    public static $img_path = 'img/articles/';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'articles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text'], 'string'],
            [['date'], 'safe'],
            [['title'], 'required'],
            [['title'], 'string', 'max' => 80],
            [['keywords', 'description'], 'string', 'max' => 255],
            [['author'], 'string', 'max' => 40],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название статьи',
            'description' => 'Описание статьи',
            'keywords' => 'Ключевые слова',
            'author' => 'Автор',
            'text' => 'Текст',
            'img' => 'Изображение',
            'date' => 'Дата',
        ];
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        $this->img = $this->renameImgFile($_POST['cimg'], null, empty($_POST['old_img']) ? null : $_POST['old_img']);
        return parent::save($runValidation, $attributeNames);
    }

    public function delete()
    {
        $this->deleteImgFile();
        return parent::delete();
    }
}
