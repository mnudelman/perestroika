<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 16.12.16
 * Time: 15:55
 */

namespace app\controllers;
use yii\web\Controller;
use Yii ;
use yii\helpers\Url ;

class BaseController extends Controller{
    private $LANGUAGE_ENGLISH = 'en-US' ;
    private $LANGUAGE_RUSSIAN = 'ru-RU' ;

    public function actionLanguage($ln)
    {
        $currentController = Yii::$app->controller->id ;
        $arr = explode('-',Yii::$app->language) ;
        $currentLg =  $arr[0] ;
        Yii::$app->language = ($ln === 'en') ? $this->LANGUAGE_ENGLISH : $this->LANGUAGE_RUSSIAN ;
        $_SESSION['lang'] = Yii::$app->language ;

        $url = Url::to([$currentController.'/index']) ;
//        echo $url ;
        return $this->redirect($url);
    }
}