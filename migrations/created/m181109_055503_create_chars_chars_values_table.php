<?php

use yii\db\Migration;

/**
 * Class m181109_055503_chars_chars_values_table
 */
class m181109_055503_create_chars_chars_values_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('chars_chars_values', [
            'id' => $this->primaryKey()->unsigned(),
            'chars_id' => $this->integer()->unsigned(),
            'chars_values_id' => $this->integer()->unsigned()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('chars_chars_values');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181109_055503_chars_chars_values_table cannot be reverted.\n";

        return false;
    }
    */
}
