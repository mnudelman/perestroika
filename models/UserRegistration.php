<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 24.12.16
 * Time: 21:20
 */

namespace app\models;
use yii\db\ActiveRecord ;
use Yii ;

class UserRegistration extends ActiveRecord {
     const NAME_MIN_LENGTH = 8 ;
     const NAME_MAX_LENGTH = 20 ;
     const PASSW_MIN_LENGTH = 12 ;
     const PASSW_MAX_LENGTH = 200 ;
    public $enterPassword = '' ;
    public $enterPassword_repeat = '' ;

    public static function tableName(){
        return 'user';
    }
    public function rules()
    {
        $currentDate = date('Y.m.d',time()) ;
        $ip = Yii::$app->request->userIp ;
        return [
            // username and password are both required
            [['username', 'enterPassword'],'required',],
            [['username', 'enterPassword'],'filter','filter' => function($value) {
                return strtolower(trim($value)) ;
            }],
            ['username','unique'],
            ['username','string','length' => [self::NAME_MIN_LENGTH,self::NAME_MAX_LENGTH]],
            ['enterPassword','string','length' => [self::PASSW_MIN_LENGTH,self::PASSW_MAX_LENGTH]],
            [['username','enterPassword'],'match','pattern' => '/^[\w,\-,\_]+$/i'],
            // password is compared with password_repeat
            ['enterPassword', 'compare'],
            ['date_first','default','value' => $currentDate],
            ['date_last','default','value' => $currentDate],
            ['ip','default','value' => $ip]

        ];
    }
    public function saveRegistration() {
        if ($this->validate()) {
            $this->password = Yii::$app->security->generatePasswordHash($this->enterPassword) ;
            return $this->save() ;
        }else {
            return false ;
        }
    }
}