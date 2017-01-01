<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 28.12.16
 * Time: 7:11
 */

namespace app\models;

use app\service\PageItems;
use yii\base\Model;
use yii\web\UploadedFile;


class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;
    private $_uploadedPath ;
    const UPLOAD_DIR = 'images/avatars/' ;

    public function attributeLabels()
    {
        $labelTab = PageItems::getItemText(['user','fields']) ;

        return [
            'imageFile' => $labelTab['imageFile'],
        ];
    }

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $randomSuffix = substr(\Yii::$app->security->generateRandomString(),-5) ;
            $this->_uploadedPath = self::UPLOAD_DIR .
                $this->imageFile->baseName . '_' . $randomSuffix .  '.' . $this->imageFile->extension ;
            $this->imageFile->saveAs($this->_uploadedPath);
            return true;
        } else {
            return false;
        }
    }
    public function getUploadedPath() {
        return $this->_uploadedPath ;
    }
}