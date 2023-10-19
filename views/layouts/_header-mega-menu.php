<?php
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\bootstrap5\Html;
?>
<header id="gen-header" class="gen-header-style-1 gen-has-sticky gt-mege-menu">
    <div class="gen-bottom-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <?php
                    NavBar::begin([
                        'brandLabel' => Yii::$app->name,
                        'brandUrl' => Yii::$app->homeUrl,
                        'options' => ['class' => 'navbar-expand-lg navbar-dark bg-dark fixed-top'],
                        'renderInnerContainer' => false,
                        'collapseOptions' => ['class' => 'mega-menu-wrap', 'id' => 'mega-menu-wrap-primary'],
                    ]);
                    echo Nav::widget([
                        'options' => ['class' => 'mega-menu max-mega-menu mega-menu-horizontal', 'id'=> 'mega-menu-primary'],
                        'items' => [
                            ['label' => 'Home', 'url' => ['/site/index'],
                                'linkOptions' => ['class' => 'mega-menu-link'],
                                'options' => ['class' => 'mega-menu-item mega-menu-item-type-post_type mega-menu-item-object-page mega-menu-item-home mega-align-bottom-left mega-menu-flyout']
                                ],
                            ['label' => 'About', 'url' => ['/site/about'], 'linkOptions' => ['class' => 'mega-menu-link'],],
                            ['label' => 'Contact', 'url' => ['/site/contact'], 'linkOptions' => ['class' => 'mega-menu-link'],],
                            Yii::$app->user->isGuest
                                ? ['label' => 'Login', 'url' => ['/site/login']]
                                : '<li class="mega-menu-item mega-menu-item-type-post_type mega-menu-item-object-page mega-menu-item-home mega-align-bottom-left mega-menu-flyout">'
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
