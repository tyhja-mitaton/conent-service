<?php

namespace app\components\traits;

use app\integrations\providers\vk\errors\OrdError;
use app\models\structure\Structure;
use app\models\user\enums\UserRole;
use Yii;

trait FlashAlert
{
    public function showFlash(Structure $model): void
    {
        if(!Yii::$app->user->can(UserRole::Administrator->value)) {
            if ($model->ordResponse) {
                if(!$model->ordResponse['isOk']) {
                    Yii::$app->session->setFlash('alert', [
                        'title' => 'Ошибка ' . $model->ordResponse['code'],
                        'body' => OrdError::tryFrom($model->ordResponse['code'])?->translate($model->ordResponse['data']) ?? $model->ordResponse['data']
                    ]);
                } else {
                    Yii::$app->session->setFlash('alert', [
                        'title' => 'Данные успешно отправлены в ОРД',
                        'body' => ''
                    ]);
                }
            } else {
                Yii::$app->session->setFlash('alert', [
                    'title' => 'Данные успешно сохранены',
                    'body' => ''
                ]);
            }
        }
    }
}
