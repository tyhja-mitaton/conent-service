<?php
use yii\helpers\Html;
use app\models\user\enums\UserRole;

/** @var yii\web\View $this */
/* @var \app\models\search\Album $searchModel */
/* @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'My Yii Application';
?>

<div class="container mt-5">
    <?= \yii\widgets\ListView::widget([
        'dataProvider' => $dataProvider,
        'showOnEmpty' => true,
        'itemView' => function ($model, $key, $index, $widget) {
            return $this->render('/album/_listItem', ['model' => $model]);
        },
    ]) ?>
</div>
