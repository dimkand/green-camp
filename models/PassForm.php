<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * PassForm is the model behind the pass form.
 */
class PassForm extends Model
{
    public $pass;
    public $pass_repeat;
    public $old_pass;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['pass', 'pass_repeat', 'old_pass'], 'required'],
            ['pass_repeat', 'compare', 'compareAttribute' => 'pass'],
            ['old_pass', 'validatePassword']
        ];
    }

    public function validatePassword($attribute)
    {
        $user = Users::findIdentity(Yii::$app->user->id);
        if(!$user->validatePassword(Yii::$app->request->post('PassForm')['old_pass']))
            $this->addError($attribute, 'Старый пароль введен неверно');
    }

    public function attributeLabels()
    {
        return [
            'pass' => 'Новый пароль',
            'pass_repeat' => 'Повторите новый пароль',
            'old_pass' => 'Старый пароль'
        ];
    }
}
