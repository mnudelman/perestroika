<?php
/**
 * Чтобы сохранить схему умолчания Yii2:
 *  Yii::$app->defaultRoute = 'site'                 // controller
 *  Yii::$app->controller->defaultAction = 'index'   // action & view
 *  Yii::$app->layout = 'main'                       // template
 */
namespace app\controllers;

//use Yii;
//use yii\filters\AccessControl;
use yii\web\Controller;
use Yii ;
use app\service\PageItems ;
//use yii\filters\VerbFilter;
//use app\models\LoginForm;
//use app\models\ContactForm;
use app\controllers\BaseController ;

class SiteController extends BaseController
{
     /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionAbout()
    {
        return $this->render('about');
    }
    public function actionWorkDirectGet() {
        if( Yii::$app->request->isAjax ){
            $query = Yii::$app->request->post() ;
            $wdId = $query['wdid'] ;

            $wdContent = PageItems::getItemText(['wd-' . $wdId,'content']) ; ;

            echo $wdContent['text'];
        }
    }

 }
