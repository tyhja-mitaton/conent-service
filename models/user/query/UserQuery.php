<?php

namespace app\models\user\query;

use app\models\user\enums\UserStatus;
use yii\db\ActiveQuery;

/**
 * Class UserQuery
 */
class UserQuery extends ActiveQuery
{
    /**
     * @return $this
     */
    public function notDeleted()
    {
        //$this->andWhere(['!=', 'status', UserStatus::Deleted->value]);
        return $this;
    }

    /**
     * @return $this
     */
    public function active()
    {
        //$this->andWhere(['status' => UserStatus::Active->value]);
        return $this;
    }

}
