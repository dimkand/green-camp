<?php

use yii\db\Migration;

/**
 * Handles the creation of table `goods_categories`.
 */
class m181109_054050_create_goods_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('goods_categories', [
            'id' => $this->primaryKey()->unsigned(),
            'goods_id' => $this->integer()->unsigned(),
            'category_id' => $this->integer()->unsigned()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('goods_categories');
    }
}
