<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 09.12.16
 * Time: 21:23
 */

namespace app\controllers;


use yii\web\Controller;
use app\controllers\BaseController ;

class DeveloperController extends BaseController {
    public function actionIndex()
    {
        return $this->render('index');
    }
}