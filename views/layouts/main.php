<?php

/** @var yii\web\View $this */

/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);
\app\assets\SteamlabAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<div id="page" class="site">
    <?= $this->render('_header-mega-menu') ?>
    <?php if (!empty($this->params['breadcrumbs'])): ?>
        <div class="gen-breadcrumb">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <div class="gen-breadcrumb-title"><h1><?= Html::encode($this->title) ?></h1></div>
                        <div class="gen-breadcrumb-container">
                        <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif ?>
    <div class="gentechtreethemes-contain">
        <div class="site-content-contain">
            <div id="content" class="site-content">
                <div class="gentechtreethemes-contain-area">
                    <div id="primary" class="content-area">
                        <main id="main" class="flex-shrink-0" role="main">
                            <?= Alert::widget() ?>
                            <?= $content ?>
                        </main>
                    </div>
                </div>
            </div><!-- #content -->


            <footer id="gen-footer" class="mt-auto py-3 bg-light">
                <div class="gen-footer-style-1">
                    <div class="gen-footer-top">
                        <div class="container">
                            <div class="row">
                                <div class="col-xl-3 col-md-6"></div>
                                <div class="col-xl-3 col-md-6"></div>
                                <div class="col-xl-3 col-md-6"></div>
                                <div class="col-xl-3 col-md-6"></div>
                            </div>
                        </div>
                    </div>
                    <div class="gen-copyright-footer">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 align-self-center">
                                    <span class="gen-copyright">&copy; My Company <?= date('Y') ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div><!-- .site-content-contain -->
    </div> <!-- Peaceful themes -->
</div><!-- #page -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
