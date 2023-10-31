<?php
use yii\helpers\Html;
use app\models\user\enums\UserRole;

/** @var yii\web\View $this */
/* @var \app\models\search\Album $searchModel */
/* @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'My Yii Application';
?>

<div class="container">
    <?php if(!Yii::$app->user->isGuest && Yii::$app->user->can(UserRole::Administrator->value)){?>
    <div class="gen-btn-container mt-5 mb-5">
        <?= Html::a(Yii::t('app', 'Create album'), ['album/create'], ['class' => 'gen-button']) ?>
    </div>
    <?php }?>
    <?= \yii\widgets\ListView::widget([
        'dataProvider' => $dataProvider,
        'showOnEmpty' => true,
        'itemView' => function ($model, $key, $index, $widget) {
            return $this->render('/album/_listItem', ['model' => $model]);
        },
    ]) ?>
</div>
