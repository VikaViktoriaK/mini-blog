<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\models\User;

/**
 * This is the model class for table "posts".
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $content
 *
 * @property User $user
 */
class Post extends ActiveRecord
{
    public static function tableName()
    {
        return 'posts';
    }

    public function rules()
    {
        return [
            [['title', 'content'], 'required'],
            [['content'], 'string'],
            [['user_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'title' => 'Title',
            'content' => 'Content',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
