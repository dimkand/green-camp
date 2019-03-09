<?php

use yii\db\Migration;

/**
 * Class m181109_055116_chars_values_table
 */
class m181109_055116_create_chars_values_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('chars_values', [
            'id' => $this->primaryKey()->unsigned(),
            'title' => $this->string(50)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('chars_values');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181109_055116_chars_values_table cannot be reverted.\n";

        return false;
    }
    */
}
