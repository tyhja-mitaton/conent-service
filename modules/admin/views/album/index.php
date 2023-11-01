<?php

use app\models\album\Album;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\search\Album $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Albums');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="album-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="gen-btn-container mb-5 mt-5">
        <?= Html::a(Yii::t('app', 'Add showcase'), ['create'], ['class' => 'gen-button']) ?>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            [
                'attribute' => 'showcase_id',
                'label' => 'URL',
                'format' => 'url',
                'value' => function (Album $model) {
                    return "https://vimeo.com/showcase/{$model->showcase_id}";
                }
            ],
            [
                'class' => 'yii\grid\CheckboxColumn',
                'header' => $searchModel->getAttributeLabel('for_registered_users'),
                'name' => 'registered-only',
                'checkboxOptions' => function (Album $model, $key, $index, $column) {
                    return ['checked' => (bool)$model->for_registered_users];
                }
            ],
            [
                'class' => ActionColumn::class,
                'template' => '{delete}',
                'urlCreator' => function ($action, Album $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
