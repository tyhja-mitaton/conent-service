<?php

namespace app\models\user;

use Twilio\Exceptions\RestException;
use yii\base\Exception;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    /**
     * @var
     */
    public $phone;
    /**
     * @var
     */
    public $fullname;
    /**
     * @var
     */
    public $username;
    /**
     * @var
     */
    public $password;
    /**
     * @var
     */
    public $password2;
    public $rulesAgreement;
    public $reCaptcha;
    public $is_landing;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['phone', 'username'], 'filter', 'filter' => 'trim'],
            [['phone', 'username'], 'required'],
            ['username', 'string'],
            [
                'username',
                'unique',
                'targetClass' => '\app\models\user\User',
                'message' => 'Username is already taken'
            ],
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

            [['is_landing'], 'safe'],
            [['test'], 'safe', 'on' => 'landing'],
            [['password', 'password2'], 'required'],
            ['password', 'string', 'min' => 6],
            ['password2', 'compare', 'compareAttribute' => 'password'],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'fullname' => Yii::t('app','Name'),
            'username' => Yii::t('app','Username'),
            'phone' => Yii::t('app','Phone'),
            'password' => Yii::t('app','Password'),
            'password2' => Yii::t('app','Repeat password'),
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup($profileData = [])
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->phone = $user->preparePhone($this->phone);
            $user->status = 1;
            $user->setPassword($this->password);
            try {
                $user->createSmsCode();
            } catch (RestException $e) {
                if ($e->getStatusCode() == 21211) {
                    $this->addError('phone', Yii::t('phone', 'Incorrect phone number'));
                } else {
                    $this->addError('phone', Yii::t('phone', 'Something went wrong. Try later.'));
                }
                return null;
            }
            if (!$user->save()) {
                throw new Exception("User couldn't be  saved");
            };
            $user->afterSignup($profileData);

            return $user;
        }

        return null;
    }
}
