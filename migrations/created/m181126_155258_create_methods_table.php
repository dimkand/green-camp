<?php

use yii\db\Migration;

/**
 * Handles the creation of table `methods`.
 */
class m181126_155258_create_methods_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('methods', [
            'id' => $this->tinyInteger()->unsigned(),
            'title' => $this->string('30'),
            'text' => $this->text()
        ]);
        $this->addPrimaryKey('id', 'methods', ['id']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('methods');
    }
}
