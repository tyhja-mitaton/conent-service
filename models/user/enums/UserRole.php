<?php

namespace app\models\user\enums;

use app\components\traits\EnumToArray;

enum UserRole: string
{
    use EnumToArray;

    case General = "general";
    case Administrator = "administrator";

    /**
     * @return string
     */
    public function label()
    {
        return match ($this)
        {
            self::General => \Yii::t('app', 'Пользователь'),
            self::Administrator => \Yii::t('app','Администратор'),
        };
    }
}
