<?php

namespace app\models;

use yii\db\ActiveRecord;

class Users extends ActiveRecord implements \yii\web\IdentityInterface
{
    const GROUP_ID_ADMIN = 1;
    const GROUP_ID_USER = 2;
    private $authKey;

    public static function tableName()
    {
        return 'users';
    }

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['username', 'login', 'email'], 'required'],
            ['email', 'email']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null){}

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByLogin($login)
    {
        return static::findOne(['login' => $login]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($pass)
    {
        return password_verify($pass, $this->pass);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Имя пользователя',
            'login' => 'Логин',
            'pass' => 'Пароль',
            'email' => 'Email',
            'img' => 'Изображение'
        ];
    }
}
