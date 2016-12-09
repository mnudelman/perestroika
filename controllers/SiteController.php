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
//use yii\filters\VerbFilter;
//use app\models\LoginForm;
//use app\models\ContactForm;

class SiteController extends Controller
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

 }
