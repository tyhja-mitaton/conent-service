<?php
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\bootstrap5\Html;
use app\models\user\enums\UserRole;
?>
<div class="gen-background-overlay"></div>
<div class="gen-sidebar">
    <div class="gen-close-btn">
        <a class="gen-close" href="javascript:void(0)">
            <i class="ion-close-round"></i>
        </a>
    </div>
    <div class="gen-sidebar-block mCustomScrollbar">

    </div>
</div>
<header id="gen-header" class="gen-header-default">
    <div class="gen-bottom-header gen-has-sticky">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <?php
                    NavBar::begin([
                        'brandLabel' => Yii::$app->name,
                        'brandUrl' => Yii::$app->homeUrl,
                        'options' => ['class' => 'navbar-expand-lg navbar-dark bg-dark fixed-top']
                    ]);
                    echo Nav::widget([
                        'options' => ['class' => 'navbar-nav'],
                        'items' => [
                            ['label' => 'Home', 'url' => ['/site/index']],
                            ['label' => 'Users', 'url' => ['/user/user/index'], 'visible' => Yii::$app->user->can(UserRole::Administrator->value)],
                            ['label' => 'Showcases', 'url' => ['/admin/album/index'], 'visible' => Yii::$app->user->can(UserRole::Administrator->value)],
                            Yii::$app->user->isGuest
                                ? ['label' => 'Login', 'url' => ['/site/login']]
                                : '<li class="nav-item">'
                                . Html::beginForm(['/site/logout'])
                                . Html::submitButton(
                                    'Logout (' . Yii::$app->user->identity->username . ')',
                                    ['class' => 'nav-link btn btn-link logout']
                                )
                                . Html::endForm()
                                . '</li>'
                        ]
                    ]);
                    NavBar::end();
                    ?>
                </div>
            </div>
        </div>
    </div>
</header>
