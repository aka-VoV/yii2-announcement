<?php

use yii\db\Schema;
use yii\db\Migration;

class m150331_172244_an_regions extends Migration
{

    public $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

    public function up()
    {
        $this->createTable('{{%an_regions}}', [
            'id'                => Schema::TYPE_PK,
            'tree'              => 'int(11) NOT NULL',
            'lft'               => 'int(11) NOT NULL',
            'rgt'               => 'int(11) NOT NULL',
            'depth'             => 'int(11) NOT NULL',
            'name'              => Schema::TYPE_STRING . ' NOT NULL',
            'local'             => Schema::TYPE_STRING . ' NOT NULL',
        ], $this->tableOptions);

        $this->execute($this->getRegionsSql());
    }

    private function getRegionsSql(){
        return "INSERT INTO `an_regions` (`id`, `tree`, `lft`, `rgt`, `depth`, `name`, `local`) VALUES
                (3, 3, 1, 52, 0, 'Україна', 'uk-UA'),
                (4, 3, 2, 3, 1, 'Київська обл.', 'uk-UA'),
                (5, 3, 4, 5, 1, 'Вінницька обл.', 'uk-UA'),
                (6, 3, 6, 7, 1, 'Волинська обл.', 'uk-UA'),
                (7, 3, 8, 9, 1, 'Дніпропетровська обл.', 'uk-UA'),
                (8, 3, 10, 11, 1, 'Донецька обл.', 'uk-UA'),
                (9, 3, 12, 13, 1, 'Житомирська обл.', 'uk-UA'),
                (10, 3, 14, 15, 1, 'Закарпатська обл.', 'uk-UA'),
                (11, 3, 16, 17, 1, 'Запорізька обл.', ''),
                (12, 3, 18, 19, 1, 'Івано-Франківська обл.', 'uk-UA'),
                (13, 3, 20, 21, 1, 'Кіровоградська обл.', 'uk-UA'),
                (14, 3, 22, 23, 1, 'Луганська обл.', 'uk-UA'),
                (15, 3, 24, 25, 1, 'Львівська обл.', 'uk-UA'),
                (16, 3, 26, 27, 1, 'Миколаївська обл.', 'uk-UA'),
                (17, 3, 28, 29, 1, 'Одеська обл.', 'uk-UA'),
                (18, 3, 30, 31, 1, 'Полтавська обл.', 'uk-UA'),
                (19, 3, 32, 33, 1, 'Рівненська обл.', 'uk-UA'),
                (20, 3, 34, 35, 1, 'Сумська обл.', 'uk-UA'),
                (21, 3, 36, 37, 1, 'Тернопільська обл.', 'uk-UA'),
                (22, 3, 38, 39, 1, 'Харківська обл.', 'uk-UA'),
                (23, 3, 40, 41, 1, 'Херсонська обл.', 'uk-UA'),
                (24, 3, 42, 43, 1, 'Хмельницька обл.', 'uk-UA'),
                (25, 3, 44, 45, 1, 'Черкаська обл.', 'uk-UA'),
                (26, 3, 46, 47, 1, 'Чернівецька обл.', 'uk-UA'),
                (27, 3, 48, 49, 1, 'Чернігівська обл.', 'uk-UA'),
                (28, 3, 50, 51, 1, 'АР Крим', 'uk-UA')";
    }


    public function down()
    {
        $this->dropTable('{{%an_regions}}');
        echo "m150331_172244_an_regions has been deleted.\n";
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
