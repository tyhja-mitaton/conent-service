<?php

namespace app\assets;

class SteamlabAsset extends \yii\web\AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        //'/css/style.css',
        '/template/steamlab/css/style.css',
        '/template/steamlab/css/main.css',
        '/template/steamlab/css/animate.min.css',
        '/template/steamlab/css/ionicons.min.css',
        '/template/steamlab/css/line-awesome.min.css',
        '/template/steamlab/css/magnific-popup.min.css',
        '/template/steamlab/css/megamenu.css',
        '/template/steamlab/css/owl.carousel.min.css',
        '/template/steamlab/css/responsive.css',
    ];

    public $js = [
        '/template/steamlab/js/script.js',
        '/template/steamlab/js/isotope.pkgd.min.js',
        '/template/steamlab/js/jquery.countTo.js',
        '/template/steamlab/js/jquery.magnific-popup.min.js',
        '/template/steamlab/js/loadmore.js',
        '/template/steamlab/js/owl.carousel.min.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset',
    ];
}