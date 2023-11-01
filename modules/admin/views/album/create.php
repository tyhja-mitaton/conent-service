<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \app\models\album\Album */

$this->title = Yii::t('app', 'Create album');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Albums'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="album-create">
    <div class="page-header">
        <h1 class="page-title"><span class="subpage-title"><?= Html::encode($this->title) ?></span></h1>
    </div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
