<?php

use yii\db\Migration;

/**
 * Handles the creation of table `admin_goods`.
 */
class m181109_053612_create_goods_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('admin_goods', [
            'id' => $this->primaryKey()->unsigned(),
            'title' => $this->string(80),
            'description' => $this->string(255),
            'keywords' => $this->string(255),
            'text' => $this->text(),
            'img_count' => $this->tinyInteger(),
            'price' => $this->smallInteger(),
            'date' => $this->timestamp(),
            'rating' => $this->decimal(10,9),
            'rating_count' => $this->integer()->unsigned()->defaultValue(0)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('admin_goods');
    }
}
