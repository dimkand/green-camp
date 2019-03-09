<?php

use yii\db\Migration;

/**
 * Handles the creation of table `categories`.
 */
class m181109_052451_create_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('categories', [
            'id' => $this->smallInteger()->unique()->unsigned(),
            'title' => $this->string(80),
            'img' => $this->string(50),
            'parent' => $this->smallInteger()->unsigned(),
            'type' => $this->smallInteger()->unsigned()
        ]);
        $this->addPrimaryKey('categories_pk', 'categories', ['id']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('categories');
    }
}
