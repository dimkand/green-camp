<?php

use yii\db\Migration;

/**
 * Handles the creation of table `goods_chars_values`.
 */
class m181112_081508_create_goods_chars_values_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('goods_chars_values', [
            'id' => $this->primaryKey()->unsigned(),
            'goods_id' => $this->integer()->unsigned(),
            'chars_values_id' => $this->integer()->unsigned()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('goods_chars_values');
    }
}
