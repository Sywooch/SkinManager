<?php

use yii\db\Schema;
use yii\db\Migration;

class m150221_102533_requests extends Migration
{
    public function up()
    {
		$tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%requests}}', [
            'id' => Schema::TYPE_PK,
			'user_id' => Schema::TYPE_INTEGER . ' NOT NULL',
			'date' => Schema::TYPE_INTEGER . ' NOT NULL',

            'name' => Schema::TYPE_STRING . '(255) NOT NULL',
            'type' => "enum('Скин','HD Скин','Плащ') NOT NULL",
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%requests}}');
    }
}
