<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 24.12.16
 * Time: 21:23
 */

namespace app\models;
use yii\db\ActiveRecord ;

class UserProfile extends ActiveRecord {
    private $_userProfile = false ;
    private $_userId ;
    public static function tableName(){
        return 'userprofile';
    }
    public function rules()
    {
        return [
            [['email,tel,company,info'],'required'],
            ['email','email'],
            ['email', 'unique'],
            ['site','url'],
        ];
    }
    public function setUserId($userid) {
        $this->_userId = $userid ;
    }
    public function saveProfile($profileAttributes) {
        $this->_userProfile = $this->getByUserId($this->_userId) ;
        $this->_userProfile->attributes = $profileAttributes ;
        if ($this->_userProfile->validate()) {
            $this->_userProfile->save() ;
        }
    }
    /**
     * Finds user by [[userid]]
     *
     * @return User|null
     */
    public function getByUserId($id)
    {
        if ($this->_userProfile === false) {
            $this->_userProfile = $this->findOne(['userid' => $id]) ;
        }

        return $this->_userProfile;
    }
}