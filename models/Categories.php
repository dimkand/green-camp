<?php

namespace app\models;

use app\components\Helpers;

/**
 * This is the model class for table "categories".
 *
 * @property int $id
 * @property string $title
 * @property string $img
 * @property int $parent
 */
class Categories extends Crud
{
    // путь к изображениям статей
    public static $img_path = 'img/categories/';

    public static function tableName()
    {
        return 'categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['parent', 'type'], 'integer'],
            [['title', 'description'], 'string', 'max' => 120],
            [['keywords'], 'string', 'max' => 255],
            [['alias'], 'unique'],
            [['alias'], 'required'],
            [['alias'],  'match', 'pattern' => '/^[A-Z0-9\_\-]{1,255}$/i', 'message' => \Yii::$app->params['aliasErrorMessage']]
        ];
    }

    public function getGoods()
    {
        return $this->hasMany(Goods::className(), ['id' => 'goods_id'])->viaTable(GoodsCategories::tableName(), ['category_id' => 'id']);
    }

    public function getCTypes()
    {
        return $this->hasOne(CTypes::className(), ['id' => 'type']);
    }

    public function getParent(){
        return self::findOne($this->parent);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название категории',
            'description' => 'Описание категории',
            'keywords' => 'Ключевые слова',
            'img' => 'Изображение',
            'parent' => 'Parent',
            'type' => 'Тип',
            'alias' => 'Алиас'
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
        parent::delete();

        // После удаления товаров в категории ишем подкатегории чтобы удалить их и так далее в рекурсии
        $parent_categories = self::findAll(['parent' => $this->id]);
        if (!is_array($parent_categories))
            return;
        foreach ($parent_categories as $parent_category)
            $parent_category->delete();
    }

    public function getGoodsId()
    {
        return $this->getGoods()->select('id')->asArray()->column();
    }
}
