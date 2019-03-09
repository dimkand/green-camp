<?php

use yii\db\Migration;

/**
 * Handles the creation of table `orders_goods`.
 */
class m181109_054541_create_orders_goods_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('orders_goods', [
            'id' => $this->primaryKey()->unsigned(),
            'orders_id' => $this->integer()->unsigned(),
            'goods_id' => $this->integer()->unsigned(),
            'goods_count' => $this->smallInteger()->unsigned()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('orders_goods');
    }
}
