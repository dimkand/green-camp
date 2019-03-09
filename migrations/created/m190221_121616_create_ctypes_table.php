<?php

use yii\db\Migration;

/**
 * Handles the creation of table `categoriestypes`.
 */
class m190221_121616_create_ctypes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ctypes', [
            'id' => $this->primaryKey()->unsigned(),
            'title' => $this->string(80),
        ]);
        $this->batchInsert('ctypes', ['title'], [['Раздел'] , ['Характеристика'], ['Значение']])->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('ctypes');
    }
}
