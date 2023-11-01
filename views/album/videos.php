<?php
/** @var yii\web\View $this */
/* @var yii\data\ArrayDataProvider $dataProvider */
/* @var \app\models\album\Album $album */

$this->title = $album->name;
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
    <?= \yii\widgets\ListView::widget([
        'dataProvider' => $dataProvider,
        'showOnEmpty' => true,
        'itemView' => function ($model, $key, $index, $widget) use ($album) {
            return $this->render('_videoItem', ['model' => $model, 'albumId' => $album->id]);
        },
    ]) ?>
</div>