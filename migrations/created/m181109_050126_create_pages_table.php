<?php

use yii\db\Migration;

/**
 * Handles the creation of table `pages`.
 */
class m181109_050126_create_pages_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('pages', [
            'id' => $this->string(40)->unique(),
            'title' => $this->string(80),
            'description' => $this->string(255),
            'keywords' => $this->string(255),
            'text' => $this->text()
        ]);
        $this->addPrimaryKey('pages_pk', 'pages', ['id']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('pages');
    }
}
