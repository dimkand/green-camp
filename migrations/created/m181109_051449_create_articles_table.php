<?php

use yii\db\Migration;

/**
 * Handles the creation of table `articles`.
 */
class m181109_051449_create_articles_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('articles', [
            'id' => $this->primaryKey()->unsigned(),
            'title' => $this->string(80),
            'description' => $this->string(255),
            'keywords' => $this->string(255),
            'author' => $this->string(40),
            'text' => $this->text(),
            'img' => $this->string(50),
            'date' => $this->timestamp()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('articles');
    }
}
