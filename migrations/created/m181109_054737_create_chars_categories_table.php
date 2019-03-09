<?php

use yii\db\Migration;

/**
 * Handles the creation of table `categories_chars`.
 */
class m181109_054737_create__chars_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('chars_categories', [
            'id' => $this->primaryKey()->unsigned(),
            'chars_id' => $this->integer()->unsigned(),
            'categories_id' => $this->integer()->unsigned()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('chars_categories');
    }
}
