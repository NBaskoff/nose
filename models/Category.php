<?php

namespace app\models;
use creocoder\nestedsets\NestedSetsBehavior;
use Yii;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $name
 * @property integer $parent
 * @property integer $left_key
 * @property integer $right_key
 * @property integer $level
 */
class Category extends \yii\db\ActiveRecord
{
    public function behaviors() {
        return [
            'tree' => [
                'class' => NestedSetsBehavior::className(),
            ],
        ];
    }

    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public static function find()
    {
        return new CategoryQuery(get_called_class());
    }    
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lft', 'rgt', 'depth', 'parent'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['name'], "required"],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'lft' => 'Left Key',
            'rgt' => 'Right Key',
            'depth' => 'Level',
        ];
    }
    
    public function getNews() {
        return $this->hasMany(News::className(), ["category"=>"id"]);
    }
    
    public function getMaybeParents() {
        $root = static::find()->roots()->one();
        $query = static::find()
            ->where("lft >= {$root->lft}")
            ->where("rgt <= {$root->rgt}")
            ->orderBy("lft ASC")
        ;
        if (!empty($this->lft)) {
            $query = $query->
                where("lft < {$this->lft}")
                ->orWhere("lft > {$this->rgt}");
        }
            
        return $query->all();
    }
    public function getCountNews() {
        $records = $this->children()->all();
        $ids = [$this->id];
        if (!empty($records)) foreach ($records as $k=>$i) {
            $ids[] = $i->id;
        }
        $ids = implode(",", $ids);
        return News::find()->where("category IN ($ids)")->count();
    }
}
