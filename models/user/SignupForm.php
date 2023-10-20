<?php

namespace app\models\user;

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
    public $username;
    /**
     * @var
     */
    public $fullname;
    /**
     * @var
     */
    public $email;
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
            ['username', 'required'],
            [
                'username',
                'unique',
                'targetClass' => '\app\models\user\User',
                'message' => 'Пользователь уже существует'
            ],
            [['username'], 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            [
                'email',
                'unique',
                'targetClass' => '\app\models\user\User',
                'message' => 'Электронная почта уже занята'
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
            'username' => Yii::t('app','Логин'),
            'fullname' => Yii::t('app','Имя'),
            'email' => Yii::t('app','Email'),
            'password' => Yii::t('app','Пароль'),
            'password2' => Yii::t('app','Повторный пароль'),
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
            //$shouldBeActivated = $this->shouldBeActivated();
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->status = 1;
            $user->setPassword($this->password);
            //$user->beforeSignup();
            if (!$user->save()) {
                throw new Exception("User couldn't be  saved");
            };
            $user->afterSignup($profileData);
            /*if ($shouldBeActivated) {
                $token = UserToken::create($user->id, UserToken::TYPE_ACTIVATION, Time::SECONDS_IN_A_DAY);
                Yii::$app->commandBus->handle(new SendEmailCommand([
                    'subject' => 'Account activation',
                    'view' => 'activation',
                    'to' => $this->email,
                    'params' => [
                        'url' => Url::to(['/user/sign-in/activation', 'token' => $token->token])
                    ]
                ]));
            }*/

            return $user;
        }

        return null;
    }
}
