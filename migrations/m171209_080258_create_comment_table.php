<?php

use yii\db\Migration;

/**
 * Handles the creation of table `comment`.
 */
class m171209_080258_create_comment_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('comment', [
            'id' => $this->primaryKey(),
            "news" => $this->integer(),
            "body" => $this->text(),
        ]);
        $this->createIndex("idx-news", "comment", "news");
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('comment');
    }
}
