<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property integer $id
 * @property string $dt
 * @property string $name
 * @property string $preview
 * @property string $body
 * @property integer $status
 * @property integer $category
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [["name"], "required"],
            [["name"], "unique"],
            [['name'], 'string', 'max' => 255],
            [["dt"], "date", "format"=>"php:Y-m-d"],
            [["dt"], "default", "value"=> date("Y-m-d")],
            [['preview', 'body'], 'string'],
            [['status', 'category'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dt' => 'Dt',
            'name' => 'Name',
            'preview' => 'Preview',
            'body' => 'Body',
            'status' => 'Status',
            'category' => 'Category',
        ];
    }
    public function getCategoryModel() {
        return $this->hasOne(Category::className(), ["id"=>"category"]);
    }
    public function getComment() {
        return $this->hasMany(Comment::className(), ["news"=>"id"]);
    }

    
}
