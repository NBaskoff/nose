<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m171209_080239_create_admin_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('admin_user', [
            'id' => $this->primaryKey(),
            "name"=> $this->string(),
            "login"=> $this->string(),
            "pass"=> $this->string(),
        ]);
        $this->createIndex("idx-login-pass", "admin_user", [
            "login", "pass"
        ]);

        $this->insert("admin_user", [
            "name" => "Admin",
            "login"=> "login",
            "pass" => md5("password")
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user');
    }
}
