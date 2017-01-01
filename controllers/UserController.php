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
        $userRegAttr = (Yii::$app->request->post('UserRegistration'));
        $modelRegistration->enterPassword_repeat = $userRegAttr['enterPassword_repeat'];
        if ($modelRegistration->load(Yii::$app->request->post()) && $modelRegistration->saveRegistration()
        ) {
            $success = true;
            $loginForm = new LoginForm();
            $loginForm->username = $modelRegistration->username;
            $loginForm->password = $modelRegistration->enterPassword;
            $loginForm->login();

            $user = $loginForm->getUser();
            $profile = UserProfile::findOne(['userid' => $user->id]);
            $profile->load(Yii::$app->request->post());

            $success = $success && $profile->save();

            $errors = array_merge($profile->errors, $modelRegistration->errors);
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

    public function actionProfile()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $userId  = Yii::$app->user->identity->id ;
        $userProfile =  UserProfile::findOne(['userid' => $userId]);
        $oldAttributes = $userProfile->attributes ;
        $opcod = Yii::$app->request->post('opcod') ;
// если запрос 'get' на имеющиеся значения, то сохранять не надо
        $success = true ;
        if ($opcod === 'save') {
            $userProfile->load(Yii::$app->request->post()) ;
            $success = $userProfile->save() ;
        }

        $errors = $userProfile->errors ;
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