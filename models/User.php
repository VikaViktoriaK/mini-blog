<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * Модель пользователя для таблицы "users".
 *
 * @property int    $id
 * @property string $email
 * @property string $password_hash
 * @property string $auth_key
 */
class User extends ActiveRecord implements IdentityInterface
{
    public static function tableName()
    {
        return 'users';
    }

    /** Валидация полей (на случай форм/сидов) */
    public function rules()
    {
        return [
            [['email', 'password_hash', 'auth_key'], 'required'],
            ['email', 'email'],
            [['email'], 'string', 'max' => 255],
            [['password_hash'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['email'], 'unique'], // убедитесь, что в БД есть уникальный индекс на email
        ];
    }

    /** Метки (если будете показывать в формах/GridView) */
    public function attributeLabels()
    {
        return [
            'id'            => 'ID',
            'email'         => 'Email',
            'password_hash' => 'Password Hash',
            'auth_key'      => 'Auth Key',
        ];
    }

    /* ===== IdentityInterface ===== */

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null; // не используете токены — возвращаем null
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    /* ===== Утилиты для логина по email ===== */

    public static function findByEmail(string $email): ?self
    {
        return static::findOne(['email' => $email]);
    }

    public function validatePassword(string $password): bool
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    public function setPassword(string $password): void
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    public function generateAuthKey(): void
    {
        $this->auth_key = Yii::$app->security->generateRandomString(32);
    }

    public function beforeSave($insert)
    {
        if ($insert && empty($this->auth_key)) {
            $this->generateAuthKey();
        }
        return parent::beforeSave($insert);
    }
}
