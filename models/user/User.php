<?php

namespace app\models\user;

use app\models\user\traits\Auth;
use app\models\user\traits\Finders;
use app\models\user\traits\Relations;
use app\models\user\traits\Roles;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii2tech\ar\softdelete\SoftDeleteBehavior;
use Yii;
use app\models\user\enums\UserRole;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $access_token
 * @property string $password_hash
 * @property string $oauth_client
 * @property string $oauth_client_user_id
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $logged_at
 * @property bool $is_deleted
 * @property integer $status_moderation
 * @property string $role
 * @property integer $phone
 * @property string $confirm_code
 * @property integer $registration_type
 *
 */

class User extends ActiveRecord implements \yii\web\IdentityInterface
{
    use Auth,
        Finders,
        Relations,
        Roles;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            'softDeleteBehavior' => [
                'class' => SoftDeleteBehavior::class,
                'softDeleteAttributeValues' => [
                    'is_deleted' => true
                ],
            ],
            'auth_key' => [
                'class' => AttributeBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'auth_key'
                ],
                'value' => Yii::$app->getSecurity()->generateRandomString()
            ],
            'access_token' => [
                'class' => AttributeBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'access_token'
                ],
                'value' => function () {
                    return Yii::$app->getSecurity()->generateRandomString(40);
                }
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email', 'phone'], 'unique'],
            ['status', 'default', 'value' => 1],
            //['status', 'in', 'range' => array_keys(UserStatus::array())],
            [['username'], 'filter', 'filter' => '\yii\helpers\Html::encode'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Login',
            'email' => 'E-mail',
            'status' => 'Status',
            'access_token' => 'API token',
            'created_at' => 'Registration date',
            'updated_at' => 'Updated at',
            'logged_at' => 'Logged at',
        ];
    }

    /**
     * Creates user profile and application event
     * @param array $profileData
     */
    public function afterSignup(array $profileData = [])
    {
        $this->refresh();
        $profile = new UserProfile();
        $profile->locale = Yii::$app->language;
        $profile->load($profileData, '');
        $this->link('userProfile', $profile);
        $this->trigger('afterSignup');
        // Default role
        $auth = Yii::$app->authManager;
        $auth->assign($auth->getRole(UserRole::General->value), $this->getId());
    }
}
