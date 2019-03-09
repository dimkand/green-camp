<?php

use yii\db\Migration;

/**
 * Handles the creation of table `comments`.
 */
class m181116_131854_create_comments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('comments', [
            'id' => $this->primaryKey()->unique(),
            'name' => $this->string('20'),
            'text' => $this->text(),
            'goods_id' => $this->integer()->unsigned()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('comments');
    }
}
