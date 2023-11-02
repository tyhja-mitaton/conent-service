<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\user\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <article class="page type-page status-publish hentry">
        <div class="entry-content">
            <p><strong></strong></p>
            <?php $form = ActiveForm::begin([
                'id' => 'pms_login',
                'fieldConfig' => [
                    'template' => "{label}\n{input}\n{error}",
                    'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
                    'inputOptions' => ['class' => 'col-lg-3 form-control'],
                    'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
                ],
            ]); ?>
            <h4><?= Html::encode($this->title) ?></h4>
            <strong>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'rememberMe')->checkbox([
                    'id' => 'rememberme'
                ]) ?>

                <div class="form-group">
                    <div>
                        <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                    </div>
                </div>
                <p class="login-extra">
                    Don't have account yet? <?= Html::a('Sign up', ['signup']) ?>
                </p>
            </strong>
            <?php ActiveForm::end(); ?>
        </div>
    </article>
</div>
