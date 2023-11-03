<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var yii\web\View $this */
/* @var \yii\bootstrap5\ActiveForm $form */
/* @var \app\models\user\LoginPhoneForm $model */
$this->title = Yii::t('app', 'Sign In');
?>
    <div class="row p-5 mt-5"><div class="col-12">
    <div class="container-login100">
        <div class="wrap-login100 p-0">
            <div class="wrap-login100 p-0">
                <div class="card-body">
                    <?php $form = ActiveForm::begin([
                        'id' => 'pms_login',
                        'options' => ['class' => 'login100-form validate-form', 'autocomplete' => 'off'],
                        'enableClientValidation' => false
                    ]); ?>
                    <h4><?= Html::encode($this->title) ?></h4>
                    <div class="input-group mb-3">
                        <?php echo $form->field($model, 'username')->textInput() ?>
                        <?php echo $form->field($model, 'confirm_code')->textInput(['autofocus' => true]) ?>
                    </div>

                    <?= $form->errorSummary($model) ?>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block"><?=Yii::t('app','Login')?></button>
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
   </div></div>