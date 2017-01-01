<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 24.12.16
 * Time: 21:23
 */

namespace app\models;
use yii\db\ActiveRecord ;
use app\service\PageItems ;

class UserProfile extends ActiveRecord {
    private $_userProfile = false ;
    private $_userId ;
//    public $avatar = '' ;

    public static function tableName(){
        return   'userprofile';
    }
    public function attributeLabels()
    {
        $labelTab = PageItems::getItemText(['user','fields']) ;

        return [
            'email' => $labelTab['email'],
            'tel' => $labelTab['tel'],
            'site' => $labelTab['site'],
            'company' => $labelTab['company'],
            'info' => $labelTab['info']
        ];
    }

    public function rules()
    {
        return [
            [['email','tel','company','info'],'required'],
            ['email','email'],
            ['email', 'unique'],
            ['site','url'],
            ['avatar','default']
        ];
    }
    public function setUserId($userid) {
        $this->userid = $userid ;
    }
    public function saveProfile() {
        if ($this->validate()) {
            return $this->save() ;
        }else {
            return false ;
        }

    }
    /**
     * Finds user by [[userid]]
     *
     * @return User|null
     */
    public function getByUserId($id)
    {
        $aa = $this->findOne(['userid' => $id]);
        $this->userid = $id ;
        return $aa ;
    }
}