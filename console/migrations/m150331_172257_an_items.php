<?php

use yii\db\Schema;
use yii\db\Migration;

class m150331_172257_an_items extends Migration
{
    public $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

    public function up()
    {
        $this->createTable('{{%an_items}}', [
            'id'                => Schema::TYPE_PK,
            'cat_id'            => 'int(11) NOT NULL',
            'region_id'         => 'int(11) NOT NULL',
            'status'            => 'int(11) NOT NULL',
            'created_at'        => Schema::TYPE_DATETIME . ' NOT NULL',
            'title'             => Schema::TYPE_STRING . ' NOT NULL',
            'text'              => Schema::TYPE_TEXT . ' NOT NULL',
            'person'            => Schema::TYPE_STRING . ' NOT NULL',
            'phone'             => Schema::TYPE_STRING . ' NOT NULL',
            'email'             => Schema::TYPE_STRING . ' NOT NULL',
            'site'              => Schema::TYPE_STRING . ' NOT NULL',
            'local'             => Schema::TYPE_STRING . ' NOT NULL',
        ], $this->tableOptions);

        $this->createIndex('fk_an_cats_an_items', '{{%an_items}}', 'cat_id');
        $this->createIndex('fk_an_regions_an_items', '{{%an_items}}', 'region_id');

        $this->addForeignKey('fk_an_cats_an_items', '{{%an_items}}', 'cat_id', '{{%an_cats}}', 'id', 'RESTRICT', 'RESTRICT' );
        $this->addForeignKey('fk_an_regions_an_items', '{{%an_items}}', 'region_id', '{{%an_regions}}', 'id', 'RESTRICT', 'RESTRICT' );
    }

    public function down()
    {
        $this->dropTable('{{%an_items}}');
        echo "m150331_172257_an_items has been deleted.\n";
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
