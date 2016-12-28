<?php
/**
 * контролирует операции регистрации, изменения профайла, изменение пароля
 * работает с моделями UserRegistr, UserProfile
 * регистрация получает данные через ajax, если валидация успешна, то создаётся объект
 * user = new yii\app\model\user с id.
 */

namespace app\controllers;


use yii\web\Controller;
use Yii;
use app\models\UserProfile;
use app\models\UserRegistration;
use app\models\LoginForm;

class UserController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionRegistration()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $success = false;
        $modelRegistration = new UserRegistration();
        $modelProfile = new UserProfile();
        $userRegAttr = (Yii::$app->request->post('UserRegistration')) ;
        $modelRegistration->enterPassword_repeat = $userRegAttr['enterPassword_repeat'] ;
        if ($modelRegistration->load(Yii::$app->request->post()) && $modelRegistration->saveRegistration()
             ) {
            $success = true;
            $loginForm = new LoginForm();
            $loginForm->username = $modelRegistration->username;
            $loginForm->password = $modelRegistration->enterPassword;
            $loginForm->login();

            $user = $loginForm->getUser() ;
            $modelProfile->getByUserId($user->id) ;
            $modelProfile->load(Yii::$app->request->post()) ;
            $success = $success && $modelProfile->saveProfile() ;

//            return $this->goBack();
        }
//        return $this->render('login', [
//            'model' => $model,
//        ]);
        $errors = [];
        $errors = array_merge( $modelProfile->errors, $modelRegistration->errors);
        if (Yii::$app->request->isAjax) {
            $query = Yii::$app->request->post();
            $message = (empty($errors)) ? ['oK!'] : $errors;


            $answ = [
                'success' => $success,
                'message' => $message
            ];
            echo json_encode($answ);
        }

    }
}