<?php

use yii\db\Schema;
use yii\db\Migration;

class m150220_182036_hdskins extends Migration
{
    public function up()
    {
		$tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%hdskins}}', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . '(255) NOT NULL',

            'date' => Schema::TYPE_INTEGER . ' NOT NULL',
            'rate' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
            'views' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
            'downloads' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%hdskins}}');
    }
}
