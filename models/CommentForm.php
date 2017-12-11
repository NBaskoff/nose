<?php

namespace app\models;
use app\models\Comment;
use yii\base\Model;

class CommentForm extends Model {

    public $comment;

    public function rules() {
        return [
            [["comment"], "required"],
            [['comment'], 'string', 'length' => [3, 255]],
        ];
    }
    public function saveComment($id) {
        $comment = new Comment();
        $comment->body = $this->comment;
        $comment->news = $id;
        return $comment->save();
    }
}
