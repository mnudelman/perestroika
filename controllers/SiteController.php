<?php
/**
 * Чтобы сохранить схему умолчания Yii2:
 *  Yii::$app->defaultRoute = 'site'                 // controller
 *  Yii::$app->controller->defaultAction = 'index'   // action & view
 *  Yii::$app->layout = 'main'                       // template
 */
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\UploadedFile ;
use app\service\PageItems ;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\UploadForm;
//use app\models\ContactForm;
use app\controllers\BaseController ;

class SiteController extends BaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function beforeAction($action){
        if( $action->id == 'upload' ){
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }
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

            $wdItems = PageItems::getItemText(['wd-list','content']) ;
            $wdContent = PageItems::getItemText(['wd-' . $wdId,'content']) ; ;
            $answ = [
                'title' => $wdItems[$wdId],
                'content' => $wdContent['text']
            ] ;
            echo json_encode($answ) ;
        }
    }
    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin__________()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {


            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $success = false ;
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $success = true ;

//            return $this->goBack();
        }
//        return $this->render('login', [
//            'model' => $model,
//        ]);


        if( Yii::$app->request->isAjax ){
            $query = Yii::$app->request->post() ;
            $message=  (empty($model->errors)) ? ['oK!'] : $model->errors ;


                $answ = [
                'success' => $success ,
                'message' => $message
            ] ;
            echo json_encode($answ) ;
        }
    }




    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    public function actionUpload()
    {
        $model = new UploadForm();
        $success = false ;
        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->upload()) {
                // file is uploaded successfully
                $success = true ;
            }
        }
        if( Yii::$app->request->isAjax ){
            $answ = [
                'success' => $success ,
                'message' => $model->errors,
            ] ;
            echo json_encode($answ) ;

        }else {
            return $this->render('index');
            return $this->goBack();
        }
    }
 }
