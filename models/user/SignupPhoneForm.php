<?php

namespace app\models\user;

use Twilio\Exceptions\RestException;
use Yii;
use yii\base\Exception;

class SignupPhoneForm extends \yii\base\Model
{
    /**
     * @var
     */
    public $phone;
    /**
     * @var
     */
    public $email;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['phone', 'email'], 'filter', 'filter' => 'trim'],
            [['phone', 'email'], 'required'],
            [
                'phone',
                'match',
                'pattern' => '#^[+]?[1-9][0-9-]{6,30}$#',
                'message' => Yii::t('app', 'Incorrect phone number')
            ],
            ['phone', 'filter', 'filter' => [User::class, 'preparePhone']],
            [
                'phone',
                'unique',
                'skipOnEmpty' => true,
                'targetClass' => '\app\models\user\User',
                'message' => Yii::t('app', 'The phone number is taken by another user')
            ],
            ['email', 'email'],
            [
                'email',
                'unique',
                'targetClass' => '\app\models\user\User',
                'message' => 'Email address has already been taken'
            ],
        ];
    }

    public function signup($profileData = [])
    {
        if ($this->validate()) {
            $user = new User();
            $user->phone = $user->preparePhone($this->phone);
            $user->email = $this->email;
            $user->username = $this->email;
            $user->registration_type = 1;

            $password = Yii::$app->security->generateRandomString(12);
            $user->setPassword($password);

            try {
                $user->createSmsCode();
            } catch (RestException $e) {
                if ($e->getStatusCode() == 21211) {
                    $this->addError('phone', Yii::t('phone', 'Incorrect phone number'));
                } else {
                    $this->addError('phone', Yii::t('phone', 'Something went wrong. Try later.'));
                }
                return false;
            }

            if (!$user->save()) {print_r($user->getErrorSummary(false));exit;
                throw new Exception("User couldn't be  saved");
            };
            $user->afterSignup($profileData);

            return $user;
        }

        return null;
    }

}