<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\service\PageItems ;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user = false;

    public function attributeLabels()
    {
        $labelTab = PageItems::getItemText(['user', 'fields']);

        return [
            'username' => $labelTab['username'],
            'password' => $labelTab['password'],
            'rememberMe' => $labelTab['rememberMe'],
        ];
    }
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'],'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        $messages = PageItems::getItemText(['user','forms', 'loginForm','messages']);
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (is_null($user)) {
                $this->addError($attribute, $messages['username']);
            } elseif(!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, $messages['password']);
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            if($this->rememberMe){
                $u = $this->getUser();
                $u->generateAuthKey();
                $u->ip = Yii::$app->request->userIP;
                $u->date_last = date('Y.m.d',time()) ;
                $u->save();
            }
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*5 : 0);
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}
