<?php

use yii\db\Migration;

/**
 * Handles the creation of table `category`.
 */
class m171209_080231_create_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('category', [
            'id' => $this->primaryKey(),
            "lft" => $this->integer(),
            "rgt" => $this->integer(),
            "depth" => $this->integer(),
            "parent" => $this->integer(),
            "name" => $this->string(),
        ]);
        
        $this->createIndex("idx-nested_sets", "category", [
            "lft", "rgt", "depth", "parent"
        ]);
        $this->createIndex("idx-parent", "category", [
            "parent"
        ]);        
        $this->insert("category", [
            "lft" => 1,
            "rgt" => 2,
            "depth" => 0,
            "name"=> "Категории"
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('category');
    }
}
