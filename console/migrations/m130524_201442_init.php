<?php

use yii\db\Schema;
use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        // Create tables
        $this->createTable('{{%admin}}', [
            'id' => Schema::TYPE_PK,
            'username' => Schema::TYPE_STRING . ' NOT NULL',
            'auth_key' => Schema::TYPE_STRING . '(32) NOT NULL',
            'password_hash' => Schema::TYPE_STRING . ' NOT NULL',
            'password_reset_token' => Schema::TYPE_STRING,
            'email' => Schema::TYPE_STRING . ' NOT NULL',
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);

        $this->createTable('{{%skins}}', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . '(255) NOT NULL',
            'date' => Schema::TYPE_INTEGER . ' NOT NULL',
            'rate' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
            'views' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
            'downloads' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
        ], $tableOptions);

        $this->createTable('{{%hdskins}}', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . '(255) NOT NULL',
            'date' => Schema::TYPE_INTEGER . ' NOT NULL',
            'rate' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
            'views' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
            'downloads' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
        ], $tableOptions);

        $this->createTable('{{%cloaks}}', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . '(255) NOT NULL',
            'date' => Schema::TYPE_INTEGER . ' NOT NULL',
            'rate' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
            'views' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
            'downloads' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
        ], $tableOptions);

        $this->createTable('{{%requests}}', [
            'id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'date' => Schema::TYPE_INTEGER . ' NOT NULL',
            'name' => Schema::TYPE_STRING . '(255) NOT NULL',
            'type' => "enum('Скин','HD Скин','Плащ') NOT NULL",
        ], $tableOptions);

        // Insert data
        $this->insert('{{%admin}}', [
            'username' => 'admin',
            'auth_key' => Yii::$app->security->generateRandomString(),
            'password_hash' => Yii::$app->security->generatePasswordHash('admin'),
            'email' => 'admin@example.com',
            'status' => 10,
            'created_at' => time(),
            'updated_at' => time(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%admin}}');
        $this->dropTable('{{%skins}}');
        $this->dropTable('{{%hdskins}}');
        $this->dropTable('{{%cloaks}}');
        $this->dropTable('{{%requests}}');
    }
}
