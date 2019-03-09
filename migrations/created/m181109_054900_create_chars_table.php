<?php

use yii\db\Migration;

/**
 * Handles the creation of table `chars`.
 */
class m181109_054900_create_chars_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('chars', [
            'id' => $this->primaryKey()->unsigned(),
            'title' => $this->string(50)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('chars');
    }
}
