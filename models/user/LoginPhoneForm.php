<?php

namespace app\models\user;

use Yii;

class LoginPhoneForm extends \yii\base\Model
{
    /**
     * @var
     */
    public $confirm_code;
    /**
     * @var
     */
    public $username;

    public $rememberMe = true;

    private $_user = false;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['confirm_code', 'username'], 'required'],
            [['confirm_code'], 'string', 'length' => 4],
            ['username', 'string'],
        ];
    }

    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findOne(['username' => $this->username, 'confirm_code' => $this->confirm_code]);
        }

        return $this->_user;
    }

    public function login()
    {
        if ($this->validate() && $user = $this->getUser()) {
            if(empty($user->confirm_code)) {return false;}
            return Yii::$app->user->login($user, $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }
}