<?php

namespace app\models;

use app\components\Helpers;
use Yii;
use yii2mod\cart\models\CartItemInterface;

/**
 * This is the model class for table "admin_goods".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $keywords
 * @property string $text
 * @property string $img
 * @property int $price
 * @property int $category_id
 * @property string $characteristics_id
 * @property string $date
 * @property int $rating
 */
class Goods extends Crud implements CartItemInterface
{
    public $categories = [];
    public $cimg = [];
    public $quantity = 1;
    // путь к изображениям товаров
    public static $img_path = 'img/goods/';

    public static $POPULAR_LIMIT = 4;

    public static function tableName()
    {
        return 'goods';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text'], 'string'],
            [['price'], 'integer'],
            [['date', 'rating_count'], 'safe'],
            [['title'], 'required'],
            [['categories'], 'required', 'message' => 'Необходимо выбрать хотя бы одну из категорий'],
            [['title'], 'string', 'max' => 120],
            [['keywords', 'description'], 'string', 'max' => 255],
            [['img_count'], 'integer', 'max' => 120],
            [['rating'], 'number'],
            [['popularFlag'], 'popularLimit'],
        ];
    }

    public function popularLimit($attribute){
        if(!$this->$attribute)
            return;

        $count = Goods::find()->where(['popularFlag' => 1])->count();
        if($count < self::$POPULAR_LIMIT)
            return;

        return $this->addErrors([$attribute => 'Популярных товаров должно быть не больше ' . self::$POPULAR_LIMIT]);
    }

    public function getCategories()
    {
        return $this->hasMany(Categories::className(), ['id' => 'category_id'])->viaTable(GoodsCategories::tableName(), ['goods_id' => 'id']);
    }

    public function getCategoriesId()
    {
        return $this->hasMany(GoodsCategories::className(), ['goods_id' => 'id']);
    }

    public function getComments()
    {
        return $this->hasMany(Comments::className(), ['goods_id' => 'id']);
    }

    public function load($data, $formName = null)
    {
        if(isset($data['cimg']) && $data['old_img']){
            $this->cimg = Helpers::arrDelEmpty(Helpers::arrMerge($data['cimg'], $data['old_img']));
            $this->img_count = count($this->cimg);
        }
        $this->categories = $data[ucfirst(self::tableName())]['categories'] ?? [];
        return parent::load($data, $formName);
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        if (!parent::save($runValidation, $attributeNames))
            return false;

        if (!$this->getIsNewRecord())
            GoodsCategories::deleteAll(['goods_id' => $this->id]);

        (new GoodsCategories())->batchInsert($this->categories, $this->id, 'goods_id', 'category_id');

        $i = 0;
        foreach ($this->cimg as $key => $cimg_path) {
            $img_path = Helpers::editCimgPath($cimg_path);
            $this->renameImgFile($img_path, 'img_' . $i . '.jpeg', null, $this->id);
            $this->renameImgFile($cimg_path, 'cimg_' . $i . '.jpeg', null, $this->id);
            $i++;
        }
        return true;
    }

    public function delete()
    {
        GoodsCategories::deleteAll(['goods_id' => $this->id]);
        OrdersGoods::deleteAll(['goods_id' => $this->id]);
        Comments::deleteAll(['goods_id' => $this->id]);

        for ($i = 0; $i < $this->img_count; $i++) {
            $this->deleteImgFile(self::$img_path . $this->id . '/' . 'img_' . $i . '.jpeg');
            $this->deleteImgFile(self::$img_path . $this->id . '/' . 'cimg_' . $i . '.jpeg');
        }
        if (file_exists(Yii::getAlias('@webroot') . '/' . self::$img_path . $this->id))
            rmdir(Yii::getAlias('@webroot') . '/' . self::$img_path . $this->id);
        return parent::delete();
    }

    /**
     * Returns the price for the cart item
     *
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * Returns the label for the cart item (displayed in cart etc)
     *
     * @return int|string
     */
    public function getLabel()
    {
        return $this->title;
    }

    /**
     * Returns unique id to associate cart item with product
     *
     * @return int|string
     */
    public function getUniqueId()
    {
        return $this->id;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity($value)
    {
        $this->quantity = $value;
    }

    public function updateRating($rating)
    {
        $this->rating = ($this->rating * $this->rating_count + $rating) / ($this->rating_count + 1);
        $this->rating_count++;
        $this->save(false);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Артикул',
            'title' => 'Наименование товара',
            'description' => 'Описание товара',
            'keywords' => 'Ключевые слова',
            'text' => 'Текст',
            'img' => 'Изображения',
            'price' => 'Цена',
            'date' => 'Дата',
            'rating' => 'Оценка',
            'quantity' => 'Количество',
            'popularFlag' => 'Популярность'
        ];
    }
}
