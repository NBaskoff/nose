<?php

use yii\db\Migration;

/**
 * Handles the creation of table `news`.
 */
class m171209_075932_create_news_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('news', [
            'id' => $this->primaryKey(),
            "dt" => $this->date(),
            "name" => $this->string(),
            "preview" => $this->text(),
            "body" => $this->text(),
            "status" => $this->integer(),
            "category" => $this->integer(),
        ]);
        $this->createIndex("idx-dt", "news", "dt");
        $this->createIndex("idx-status", "news", "status");
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('news');
    }
}
