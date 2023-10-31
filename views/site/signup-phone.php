<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var yii\web\View $this */
/* @var \yii\bootstrap5\ActiveForm $form */
/* @var \app\models\user\SignupPhoneForm $model */
$this->title = Yii::t('app', 'Регистрация');
?>
<div class="container-login100">
    <div class="wrap-login100 p-0">
        <div class="wrap-login100 p-0">
            <div class="card-body">
                <span class="login100-form-title"><?= Html::encode($this->title) ?></span>
                <?php $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'options' => ['class' => 'login100-form validate-form', 'autocomplete' => 'off'],
                    'enableClientValidation' => false
                ]); ?>
                <div class="input-group mb-3 mt-5">
                    <?php echo $form->field($model, 'phone', [
                        'options' => [
                            'class' => 'input-group',
                        ],
                        'template' => '
                            <div class="wrap-input100 validate-input">
                                {input}
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="zmdi zmdi-account" aria-hidden="true"></i>
                                </span>
                            </div>',
                    ])->textInput(['autofocus' => true, 'class' => 'form-control input100', 'placeholder' => $model->getAttributeLabel('phone')]) ?>
                </div>
                <div class="input-group mb-3 mt-5">
                    <?php echo $form->field($model, 'email', [
                        'options' => [
                            'class' => 'input-group',
                        ],
                        'template' => '
                            <div class="wrap-input100 validate-input">
                                {input}
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="zmdi zmdi-account" aria-hidden="true"></i>
                                </span>
                            </div>',
                    ])->textInput(['autofocus' => true, 'class' => 'form-control input100', 'placeholder' => $model->getAttributeLabel('email'), 'type' => 'email']) ?>
                </div>
                <?= $form->errorSummary($model) ?>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block"><?=Yii::t('app','Регистрация')?></button>
                    </div>
                    <div class="col-12">
                        <a href="<?= \yii\helpers\Url::to(['login']) ?>" class="btn btn-link box-shadow-0 px-0"><?=Yii::t('app','Уже есть аккаунт?')?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
