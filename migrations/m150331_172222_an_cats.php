<?php

use yii\db\Schema;
use yii\db\Migration;

class m150331_172222_an_cats extends Migration
{

    public $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

    public function up()
    {
        $this->createTable('{{%an_cats}}', [
            'id'                => Schema::TYPE_PK,
            'tree'              => 'int(11) NOT NULL',
            'lft'               => 'int(11) NOT NULL',
            'rgt'               => 'int(11) NOT NULL',
            'depth'             => 'int(11) NOT NULL',
            'name'              => Schema::TYPE_STRING . ' NOT NULL',
            'local'             => Schema::TYPE_STRING . ' NOT NULL',
        ], $this->tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%an_cats}}');
        echo "m150331_172222_an_cats has been deleted.\n";
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
