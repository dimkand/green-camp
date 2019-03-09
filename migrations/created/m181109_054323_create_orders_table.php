<?php

use yii\db\Migration;

/**
 * Handles the creation of table `orders`.
 */
class m181109_054323_create_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('orders', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string(120),
            'country' => $this->string(25),
            'region' => $this->string(40),
            'town' => $this->string(30),
            'method_id' => $this->tinyInteger(),
            'address' => $this->string(255),
            'phone' => $this->char(11),
            'date' => $this->timestamp(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('orders');
    }
}
