<?php
/**
 *  часть шаблона - Верхняя часть страницы
 */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\service\PageItems ;
use yii\bootstrap\Modal ;

?>
<?php
  $labelTab = PageItems::getItemText(['topMenu']) ;
  $urlTab = PageItems::getItemAttr('url',['topMenu']) ;
  $langFlag = true ;
  $imgTab = PageItems::getItemAttr('language',['topMenu','images'],$langFlag) ;
  $langImage = $imgTab['language'] ;
  $currentController = Yii::$app->controller->id ;
  $urlEn = Url::to([$currentController.'/language','ln'=>'en']) ;
  $urlRu = Url::to([$currentController.'/language','ln'=>'ru']) ;
  $modalUrl = Url::to([$currentController,'#'=>'myModal']) ;
?>

<div class="wrap">
    <?php
    NavBar::begin([
        'options' => [
            'class' => 'navbar-default navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left'],
        'items' => [
            ['label' => $labelTab['home'], 'url' => ['/site/index']],
            ['label' => $labelTab['about'], 'url' => ['/about/index']],
            ['label' => $labelTab['order'], 'url' => ['/order/index']],
            ['label' => $labelTab['developers'], 'url' => ['/developer/index']],
            ['label' => $labelTab['forum'], 'url' => ['/forum/index']],
            '<li role="presentation" class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
        <img src="'. $langImage .'"  class="img-responsive" alt="russian language">
        <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
        <li class="enabled"><a href="'.    $urlRu   .'">
        <img src="images/ru.png" class="img-responsive" alt="russian language"> '.$labelTab['lang-russian'] .
        '</a></li>
        <li class="enabled"><a href="'.    $urlEn   .'">
        <img src="images/en.png" class="img-responsive" alt="english language">' .$labelTab['lang-english'] .
        '</a></li>
    </ul>
  </li>',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
//            ['label' => 'Login', 'url' => ['/site/login']],
            '<li role="presentation" class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-user"></i>' . $labelTab['user-noname'] . ' <span class="caret"></span>
    </a>' .
    '<ul class="dropdown-menu">' .

          '<li></li><button type="button" class="btn btn-default btn-lg" data-toggle="modal" data-target="#myModal"
                            style="background-color: rgba(0,0,0,0); border: none; font-size: 14px; padding-top: 17px;">
                                ВОЙТИ
                    </button> </li>' .


        '<li role="presentation" class="enabled"><a href="#" data-toggle="modal" data-target="#myModal">'.$labelTab['registration'].'</a></li>' .
        '<li role="presentation" class="disabled"><a href="#">'.$labelTab['profile'].'</a></li>' .
        '<li role="presentation" class="disabled"><a href="#">'.$labelTab['office'].'</a></li>' .
    '</ul>
  </li>',
        ],
    ]);


    NavBar::end();
    ?>
    <div>
        <nav class="navbar navbar-default" style="margin-top:60px">
            <div class="container-fluid">
                <div class="row" style="background-color: white;">
                    <div class="navbar-header">
                        <a href="/site/index">
                            <img alt="Brand" class="image-logo" src="images/logo.jpg">
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>


<?php
Modal::begin([
'header' => '<h2>Hello world</h2>',
'toggleButton' => ['label' => 'click me'],
]);

echo 'Say hello...';

Modal::end();