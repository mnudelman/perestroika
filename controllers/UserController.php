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
        if ($modelRegistration->load(Yii::$app->request->post()) && $modelRegistration->saveRegistration()
             ) {
            $success = true;
            $loginForm = new LoginForm();
            $loginForm->username = $modelRegistration->username;
            $loginForm->login();

            $user = $loginForm->getUser() ;

            $profileAttributes = Yii::$app->request->post('UserProfile') ;
            $modelProfile->saveProfile($profileAttributes) ;


//            return $this->goBack();
        }
//        return $this->render('login', [
//            'model' => $model,
//        ]);
        $errors = [];
        $errors = array($errors, $modelProfile->errors, $modelRegistration->errors);
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