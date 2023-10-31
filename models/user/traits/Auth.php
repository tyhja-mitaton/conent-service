<?php

namespace app\models\user\traits;

use Yii;

trait Auth
{
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::find()
            ->active()
            ->andWhere(['id' => $id])
            ->limit(1)
            ->one();
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::find()
            ->active()
            ->andWhere(['access_token' => $token])
            ->limit(1)
            ->one();
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::find()
            ->active()
            ->andWhere(['username' => $username])
            ->limit(1)
            ->one();
    }

    /**
     * Finds user by username or email
     *
     * @param string $login
     * @return static|null
     */
    public static function findByLogin($login)
    {
        return static::find()
            ->active()
            ->andWhere(['or', ['username' => $login], ['email' => $login]])
            ->limit(1)
            ->one();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     * @package string $field
     */
    public function validatePassword($password, $field = 'password_hash')
    {
        return Yii::$app->getSecurity()->validatePassword($password, $this->{$field});
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->getSecurity()->generatePasswordHash($password);
    }

    public function setToken($token)
    {
        $this->token_hash = Yii::$app->getSecurity()->generatePasswordHash($token);
    }

    public function createSmsCode()
    {
        if (Yii::$app->params['isPhoneCodesDisabled']) {
            $this->confirm_code = '0000';
        } else {
            $this->confirm_code = str_pad((string)random_int(1111, 9999), 4, '0', STR_PAD_LEFT);
        }
        $this->updateAttributes(['confirm_code']);

        if (!Yii::$app->params['isPhoneCodesDisabled']) {
            $messages = [
                'code' => Yii::t('user', 'Your verification code: {code}', ['code' => $this->confirm_code]),
            ];

            $message = $messages['code'];
            Yii::$app->twilio->sms(
                '+' . $this->phone,
                $message,
                ['from' => Yii::$app->twilio->phoneNumber]
            );
        }
        return true;
    }

    public static function preparePhone($phone)
    {
        return preg_replace("/[^0-9]/", "", $phone);
    }
}
