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
use yii\bootstrap\Modal ;
use yii\widgets\ActiveForm ;
use app\models\LoginForm ;
use app\service\PageItems ;
use app\models\UserProfile ;
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
  $langImages = PageItems::getItemAttr('',['topMenu','images']) ;
  $langImageRu = 'images/ru.png' ;
  $langImageEn = 'images/en.png' ;
  $userIsGuest = Yii::$app->user->isGuest ;
  $guestName =  $labelTab['user-noname'] ;
  $userName = ($userIsGuest) ? $guestName : Yii::$app->user->identity->username ;

$imgAvatarName = '' ;
  $imgAvatarEmpty = 'people.png' ;
  if (!$userIsGuest) {
      $uid = Yii::$app->user->identity->id  ;
      $profile = UserProfile::findOne(['userid' => $uid]) ;
      $imgAvatarName = $profile->avatar ;
  }
  $imgAvatarName = (empty($imgAvatarName)) ? $imgAvatarEmpty : $imgAvatarName ;
  $imgAvatar = Html::img('images/avatars/' . $imgAvatarName ,
      ['alt'=>'аватар','id' => 'topmenu-avatar','class' => 'img-responsive topmenu-avatar-image']) ;
// 'class'=>'img-responsive',
?>

<div class="wrap">
    <?php
    NavBar::begin([
        'options' => [
            'class' => 'navbar-default navbar-fixed-top',
        ],
    ]);
      $img = Html::img($langImage ,
          ['class'=>'topmenu-lang-image','alt'=>'выбор языка']) ;
      // заголовок  dropdown
      $a = Html::beginTag('a',
               ['class' => 'dropdown-toggle',
               'data-toggle' => "dropdown", 'href' => "#",
               'role' => "button", 'aria-haspopup' => "true",'aria-expanded'=>"false"])  . $img .
                 '<span class="caret"></span>' . Html::endTag('a') ;
    // тело dropdown
    $imgRu = Html::img($langImageRu ,['class'=>'img-responsive topmenu-lang-image']) ;
    $imgEn = Html::img($langImageEn ,['class'=>'img-responsive topmenu-lang-image']) ;

    // li - ru
    $aRu = Html::beginTag('a', ['href' => $urlRu ]) . $imgRu . $labelTab['lang-russian'] . Html::endTag('a') ;
    $liRu = Html::beginTag('li',['class' => "enabled"]) . $aRu . Html::endTag('li') ;
    //
     // li - en
    $aEn = Html::beginTag('a', ['href' => $urlEn ]) . $imgEn . $labelTab['lang-english'] . Html::endTag('a') ;
    $liEn = Html::beginTag('li',['class' => "enabled"]) . $aEn . Html::endTag('li') ;
    //
    $ulDropdownMenu = Html::beginTag('ul',['class' => "dropdown-menu"]) . $liRu . $liEn .Html::endTag('ul') ;
    $liTotalDropdown = Html::beginTag('li',['class' =>"dropdown", 'role' => "presentation"]) . $a . $ulDropdownMenu .
                       Html::endTag('li') ;
    $enable = (!$userIsGuest) ? 'enable' : 'disabled' ;
    $aForum = Html::beginTag('a', ['href' => 'forum/index']) . $labelTab['forum'] . Html::endTag('a') ;
    $liForum = Html::beginTag('li',['class' => $enable, 'id' => 'topmenu-forum']) . $aForum . Html::endTag('li') ;

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left'],
        'items' => [
            ['label' => $labelTab['home'], 'url' => ['/site/index']],
            ['label' => $labelTab['about'], 'url' => ['/about/index']],
            ['label' => $labelTab['order'], 'url' => ['/order/index']],
            ['label' => $labelTab['developers'], 'url' => ['/developer/index']],

            $liForum,
            $liTotalDropdown,
        ],
    ]);

 // сборка  dropdown

    // заголовок  dropdown
    $a = Html::beginTag('a',
            ['class' => 'dropdown-toggle',
                'id' => '',
                'data-toggle' => "dropdown", 'href' => "#",
                'role' => "button", 'aria-haspopup' => "true",'aria-expanded'=>"false"])  .
        $imgAvatar . '<span id="topmenu-username">' . $userName .'</span>' .
        '<span class="caret"></span>' . Html::endTag('a') ;
    // тело dropdown


    // li - logout
    $enable = (!$userIsGuest) ? 'enable' : 'disabled' ;
    $hidden = ($userIsGuest) ? '"hidden",' : null ;
    $aEnter = Html::beginTag('a', ['href' => '#']) .
        $labelTab['logout'] . Html::endTag('a') ;
    $userIsGuestParam = ($userIsGuest) ? '1' : '0' ;
    $liLogout = Html::beginTag('li',['class' => $enable,'id'=> 'topmenu-logout',
            'hidden' => $hidden,
            'onClick' => 'logoutOnClick(' . $userIsGuestParam .',"'. $guestName . '")']) . $aEnter . Html::endTag('li') ;






    // li - enter
    $enable = ($userIsGuest) ? 'enable' : 'disabled' ;
    $hidden = (!$userIsGuest) ? '"hidden",' : null ;
    $aEnter = Html::beginTag('a', ['href' => '#','data-toggle'=>"modal",'data-target'=>"#enter-form" ]) .
        $labelTab['enter'] . Html::endTag('a') ;
    $userIsGuestParam = ($userIsGuest) ? '1' : '0' ;
    $liEnter = Html::beginTag('li',['class' => $enable,'id'=> 'topmenu-enter','hidden' => $hidden,
        'onClick' => 'enterTargetControl(' . $userIsGuestParam . ')']) . $aEnter . Html::endTag('li') ;
    //
    // li - registration
    //'<li role="presentation" class="enabled"><a href="#"dal" data-target="#myModal">'.$labelTab['registration'].'</a></li>' .


    $enable = ($userIsGuest) ? 'enable' : 'disabled' ;
    $hidden = (!$userIsGuest) ? '"hidden",' : null ;
    $aRg = Html::beginTag('a', ['href' => '#','data-toggle'=>"modal",'data-target'=>"#registration-form"  ])  .
        $labelTab['registration'] . Html::endTag('a') ;
    $liRg = Html::beginTag('li',['class' => $enable,'id'=> 'topmenu-registration','hidden' => $hidden,
        'onClick' => 'enterTargetControl(' . $userIsGuestParam . ')']) . $aRg . Html::endTag('li') ;
    //

    // li - profile
    $enable = (!$userIsGuest) ? 'enable' : 'disabled' ;
    $aProfile = Html::beginTag('a', ['href' => '#','data-toggle'=>"modal",'data-target'=>"#profile-form" ]) .
        $labelTab['profile'] . Html::endTag('a') ;
    $liProfile = Html::beginTag('li',['class' => $enable,'id'=> 'topmenu-profile']) . $aProfile . Html::endTag('li') ;
    //

    // li - office
    $enable = (!$userIsGuest) ? 'enable' : 'disabled' ;
    $aOffice = Html::beginTag('a', ['href' => '#' ]) .  $labelTab['office'] . Html::endTag('a') ;
    $liOffice = Html::beginTag('li',['class' => $enable,'id'=> 'topmenu-office']) . $aOffice . Html::endTag('li') ;
    //

    $ulDropdownMenu = Html::beginTag('ul',['class' => "dropdown-menu"]) .
        $liLogout . $liEnter . $liRg . $liProfile . $liOffice .Html::endTag('ul') ;
    $liTotalDropdown = Html::beginTag('li',['class' =>"dropdown", 'role' => "presentation"]) . $a . $ulDropdownMenu .
        Html::endTag('li') ;







    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [ $liTotalDropdown,
        ],
    ]);
    NavBar::end();
    ?>

    <div>
        <nav class="navbar navbar-default" style="margin-top:90px">
            <div class="container-fluid">
                <div class="row" style="background-color: white;">
                    <div class="navbar-header">
                        <a href="site/index">
                            <img alt="Brand" class="image-logo" src="images/logo.jpg">
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>


