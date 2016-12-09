<?php
/*
  * Главный шаблон
  */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
$pageNames = [
    'homePage' => 'Перестройка',
    'developersList' => 'исполнители',
    'newOrder' => 'заказ',
    'about' => 'о сайте',
    'registration' => 'регистрация',
    'forum' => 'форум',
    'authorisation' => 'авторизация',
    'languageTrigger' => 'язык',
    'privateOffice' => 'кабинет'
] ;
$PAGE_DEFAULT = 'homePage' ;
$currentPage = (isset($_GET['page'])) ? $_GET['page'] :  $PAGE_DEFAULT ;
$pageName = ( isset($pageNames[$currentPage]) ) ? $pageNames[$currentPage] : 'noName' ;
$prefix = ($currentPage === 'homePage') ? '' : 'Пере...|' ;

$title =  $prefix . $pageName ;
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <?php
//        include __DIR__ . "/layoutParts/headPart.php";

        ?>
<!--        --><?//=$this->render('layoutParts/headPart')?>
<!--        <title>--><?//= $title ?><!--</title>-->
<!--        <link id="page_favicon" href="images/favicon.ico" rel="icon" type="image/x-icon" >-->
        <meta charset="<?= Yii::$app->charset ?>">

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($title) ?></title>

        <?php $this->head() ?>

        <link id="page_favicon" href="images/favicon.ico" rel="icon" type="image/x-icon" />
     <style>
         body {
             background: url(images/bg/linen.jpg) ;
         /*background: url(images/bg/bg-light-4865.png)*/
         }

     </style>


    </head>
<body>
<?php $this->beginBody() ?>


<div class="wrap">
    <?php
    NavBar::begin([
//        'brandLabel' => 'My Company',
//        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-default navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'About', 'url' => ['/about/index']],
            ['label' => 'Order', 'url' => ['/order/index']],
//            Yii::$app->user->isGuest ? (
//            ['label' => 'Login', 'url' => ['/site/login']]
//            ) : (
//                '<li>'
//                . Html::beginForm(['/site/logout'], 'post')
//                . Html::submitButton(
//                    'Logout (' . Yii::$app->user->identity->username . ')',
//                    ['class' => 'btn btn-link logout']
//                )
//                . Html::endForm()
//                . '</li>'
//            )
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            Yii::$app->user->isGuest ? (
            ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>
    <div>
        <nav class="navbar navbar-default" style="margin-top:30px">
            <div class="container-fluid">
                <div class="row" style="background-color: white;">
                    <div class="navbar-header">
                        <a href="#">
                            <img alt="Brand" class="image-logo" src="images/logo.jpg">
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </div>

    <div class="container">
        <?= $content ?>
    </div>
</div>

<?=$this->render('layoutParts/footerPart')?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>






























<!-- --><?//=$this->render('layoutParts/topMenu')?>
<!---->
<!--    <div class="container body-content">-->
<!---->
<!--        --><?php
//          debug('language: ' . yii::$app->language) ;
//          debug('sourceLanguage: ' . yii::$app->sourceLanguage) ;
//        ?>
<!---->
<!--        --><?//=$this->render('layoutParts/'.$currentPage)?>
<!--    </div>-->
<?php
//
//?>
<?//=$this->render('layoutParts/footerPart')?>
<?php //$this->endBody() ?>
<!--</body>-->
<!--</html>-->
<?php //$this->endPage() ?>










<?php

/* @var $this \yii\web\View */
/* @var $content string */

//use yii\helpers\Html;
//use yii\bootstrap\Nav;
//use yii\bootstrap\NavBar;
//use yii\widgets\Breadcrumbs;
//use app\assets\AppAsset;
//
//AppAsset::register($this);
?>
<?php //$this->beginPage() ?>
<!--<!DOCTYPE html>-->
<!--<html lang="--><?//= Yii::$app->language ?><!--">-->
<!--<head>-->
<!--    <meta charset="--><?//= Yii::$app->charset ?><!--">-->
<!--    <meta name="viewport" content="width=device-width, initial-scale=1">-->
<!--    --><?//= Html::csrfMetaTags() ?>
<!--    <title>--><?//= Html::encode($this->title) ?><!--</title>-->
<!--    --><?php //$this->head() ?>
<!--</head>-->
<!--<body>-->
<?php //$this->beginBody() ?>
<!---->
<!--<div class="wrap">-->
<!--    --><?php
//    NavBar::begin([
//        'brandLabel' => 'My Company',
//        'brandUrl' => Yii::$app->homeUrl,
//        'options' => [
//            'class' => 'navbar-inverse navbar-fixed-top',
//        ],
//    ]);
//    echo Nav::widget([
//        'options' => ['class' => 'navbar-nav navbar-right'],
//        'items' => [
//            ['label' => 'Home', 'url' => ['/site/index']],
//            ['label' => 'About', 'url' => ['/site/about']],
//            ['label' => 'Contact', 'url' => ['/site/contact']],
//            Yii::$app->user->isGuest ? (
//            ['label' => 'Login', 'url' => ['/site/login']]
//            ) : (
//                '<li>'
//                . Html::beginForm(['/site/logout'], 'post')
//                . Html::submitButton(
//                    'Logout (' . Yii::$app->user->identity->username . ')',
//                    ['class' => 'btn btn-link logout']
//                )
//                . Html::endForm()
//                . '</li>'
//            )
//        ],
//    ]);
//    NavBar::end();
//    ?>
<!---->
<!--    <div class="container">-->
<!--        --><?//= Breadcrumbs::widget([
//            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
//        ]) ?>
<!--        --><?//= $content ?>
<!--    </div>-->
<!--</div>-->
<!---->
<!--<footer class="footer">-->
<!--    <div class="container">-->
<!--        <p class="pull-left">&copy; My Company --><?//= date('Y') ?><!--</p>-->
<!---->
<!--        <p class="pull-right">--><?//= Yii::powered() ?><!--</p>-->
<!--    </div>-->
<!--</footer>-->
<!---->
<?php //$this->endBody() ?>
<!--</body>-->
<!--</html>-->
<?php //$this->endPage() ?>















