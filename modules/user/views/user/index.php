<?php

use app\models\user\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\user\enums\UserRole;

/** @var yii\web\View $this */
/** @var app\models\search\User $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'username',
            'phone',
            [
                'class' => 'yii\grid\CheckboxColumn',
                'header' => Yii::t('app', 'Set as admin'),
                'name' => 'select-user',
                'checkboxOptions' => function ($model, $key, $index, $column) {
                    return ['checked' => $model->can(UserRole::Administrator->value)];
                }
            ],
            [
                'class' => ActionColumn::class,
                'template' => '{delete} {restore}',
                'urlCreator' => function ($action, User $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 },
                'visibleButtons' => [
                    'delete' => function (User $model, $key, $index) {
                        return !$model->is_deleted;
                    },
                    'restore' => function (User $model, $key, $index) {
                        return $model->is_deleted;
                    },
                ]
            ],
        ],
    ]); ?>


</div>
