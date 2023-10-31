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
    public $phone;

    public $rememberMe = true;

    private $_user = false;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['confirm_code'], 'required'],
            [['confirm_code'], 'string', 'length' => 4],
            [['phone'], 'filter', 'filter' => 'trim'],
            ['phone', 'required'],
            [
                'phone',
                'match',
                'pattern' => '#^[+]?[1-9][0-9-]{6,30}$#',
                'message' => Yii::t('app', 'Incorrect phone number')
            ],
            ['phone', 'filter', 'filter' => [User::class, 'preparePhone']],
        ];
    }

    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findOne(['phone' => $this->phone, 'confirm_code' => $this->confirm_code]);
        }

        return $this->_user;
    }

    public function login()
    {
        if ($this->validate() && $user = $this->getUser()) {
            return Yii::$app->user->login($user, $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }
}