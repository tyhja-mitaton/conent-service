<?php

namespace app\models\user\traits;

use Yii;

trait Roles
{
    public function getRole()
    {
        $list = [];
        foreach (Yii::$app->authManager->getRolesByUser($this->id) as $role) {
            $list[] = $role->name;
        }
        return implode(', ', $list);
    }

    public function checkRole($roleName)
    {
        foreach (Yii::$app->authManager->getRolesByUser($this->id) as $role) {
            if ($role->name == $roleName) {
                return true;
            }
        }
        return false;
    }

    public function can($role)
    {
        return Yii::$app->authManager->checkAccess($this->id, $role);
    }
}
