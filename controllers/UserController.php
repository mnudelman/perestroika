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
//        if (!Yii::$app->user->isGuest) {
//            return $this->goHome();
//        }
        $success = false;
        $successUser = false ;
        $successProfile = false ;
        $profile = UserProfile::find() ;

        if  (Yii::$app->user->isGuest) {
            $userRegistration =new UserRegistration();
            $userRegAttr = (Yii::$app->request->post('UserRegistration'));
            $userRegistration->enterPassword_repeat = $userRegAttr['enterPassword_repeat'];
            $successUser = $userRegistration->load(Yii::$app->request->post()) &&
                           $userRegistration->saveRegistration() ;
        }else {
            $uid = Yii::$app->user->identity->id ;
            $userRegistration =UserRegistration::findOne($uid) ;
            $successUser = true ;
        }
// profile обрабатывается, если успешно завершилась обработка user
        if ($successUser) {
            $loginForm = new LoginForm();
            $loginForm->username = $userRegistration->username;
            $loginForm->password = $userRegistration->enterPassword;
            $loginForm->login();

            $user = $loginForm->getUser();
            $profile = UserProfile::findOne(['userid' => $user->id]);
            $profile->load(Yii::$app->request->post());

            $successProfile =  $profile->save();
        }
        $errors = (isset($userRegistration->errors)) ? $userRegistration->errors : [];

        $errors = (isset($profile->errors)) ? array_merge($errors, $profile->errors) : $errors;
        $userAttributes = ($successUser) ?  $userRegistration->attributes : [0] ;
        $profileAttributes = ($successProfile) ? $profile->attributes : [0] ;


        if (Yii::$app->request->isAjax) {
            $answ = [
                'success' => $successUser && $successProfile,
                'successUser' => $successUser,
                'successProfile' => $successProfile,
                'message' => $errors,
                'userAttributes' => $userAttributes,
                'profileAttributes' => $profileAttributes
            ];
            echo json_encode($answ);
        }

    }


    public function actionProfile()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $userId = Yii::$app->user->identity->id;
        $userProfile = UserProfile::findOne(['userid' => $userId]);
        $oldAttributes = $userProfile->attributes;
        $opcod = Yii::$app->request->post('opcod');
// если запрос 'get' на имеющиеся значения, то сохранять не надо
        $success = true;
        if ($opcod === 'save') {
            $userProfile->load(Yii::$app->request->post());
            $success = $userProfile->save();
        }

        $errors = $userProfile->errors;
        if (Yii::$app->request->isAjax) {
            $message = (empty($errors)) ? ['oK!'] : $errors;

            $answ = [
                'opcod' => $opcod,
                'success' => $success,
                'message' => $message,
                'attributes' => $userProfile->attributes,
                'oldAttributes' => $oldAttributes,
            ];
            echo json_encode($answ);
        }

    }
}