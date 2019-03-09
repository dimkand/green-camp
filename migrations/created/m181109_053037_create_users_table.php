<?php

use yii\db\Migration;

/**
 * Handles the creation of table `users`.
 */
class m181109_053037_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey()->unsigned(),
            'username' => $this->string(30),
            'login' => $this->string(20),
            'pass' => $this->string(100),
            'img' => $this->string(50),
            'email' => $this->string(30),
            'group_id' => $this->tinyInteger(),
            'is_registred' => $this->tinyInteger(),
            'is_active' => $this->tinyInteger(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('users');
    }
}
