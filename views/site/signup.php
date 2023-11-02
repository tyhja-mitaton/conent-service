<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var yii\web\View $this */
/* @var \yii\bootstrap5\ActiveForm $form */
/* @var \app\models\user\SignupForm $model */
$this->title = Yii::t('app', 'Register');
?>
<div class="container">
    <article class="page type-page status-publish hentry">
        <div class="entry-content">
            <p><strong></strong></p>
                <?php $form = ActiveForm::begin([
                    'id' => 'pms_register-form',
                    'options' => ['class' => 'pms-form', 'autocomplete' => 'off'],
                    'enableClientValidation' => false
                ]); ?>
            <h4><?= Html::encode($this->title) ?></h4>
            <strong>
                <ul class="pms-form-fields-wrapper">
                <li class="pms-field">
                    <?php echo $form->field($model, 'phone')->textInput(['autofocus' => true]) ?>
                </li>
                <li class="pms-field">
                    <?php echo $form->field($model, 'email')->textInput(['type' => 'email']) ?>
                </li>
                <li class="pms-field">
                    <?php echo $form->field($model, 'password')->passwordInput() ?>
                </li>
                <li class="pms-field">
                    <?php echo $form->field($model, 'password2')->passwordInput() ?>
                </li>
                </ul>
                <?= $form->errorSummary($model) ?>
                <?=Html::submitButton('Register', ['class' => 'pms-form-submit'])?>
                <div class="row">
                    <div class="col-12">
                        <a href="<?= \yii\helpers\Url::to(['login']) ?>" class="btn btn-link box-shadow-0 px-0"><?=Yii::t('app','Already have an account?')?></a>
                    </div>
                </div>
            </strong>
                <?php ActiveForm::end(); ?>
            </div>
    </article>
</div>
