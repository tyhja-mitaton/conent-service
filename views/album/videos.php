<?php
/** @var yii\web\View $this */
/* @var yii\data\ArrayDataProvider $dataProvider */
/* @var string $albumName */

$this->title = $albumName;
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
    <?= \yii\widgets\ListView::widget([
        'dataProvider' => $dataProvider,
        'showOnEmpty' => true,
        'itemView' => function ($model, $key, $index, $widget) {
            return $this->render('_videoItem', ['model' => $model]);
        },
    ]) ?>
</div>