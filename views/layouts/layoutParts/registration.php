<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 26.12.16
 * Time: 21:17
 */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\models\LoginForm;
use app\models\UserRegistration;
use app\models\UserProfile;
use app\models\UploadForm;
use yii\widgets\Pjax;

?>
<?php
$mdReg = new UserRegistration();
$mdProf = new UserProfile();
$mdUpload = new UploadForm();
$title = 'myRegistration';
$urlUpload = Url::to(['site/upload']) ;
?>

<div class="modal fade" id="registration-form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="enter-modal-title"><?= Html::encode($title) ?></h4>
            </div>
            <div class="modal-body" id="modal-body">
                <div id="enter-modal-insert">
                    <div class="site-login">
                        <p>Please fill out the following fields to login:</p>
<!---->

                        <?php $form = ActiveForm::begin([
                            'id' => 'upload-form',
                            'action' => $urlUpload,
                            'options' => ['enctype' => 'multipart/form-data']] ) ;
                        ?>

                        <?= $form->field($mdUpload, 'imageFile')->fileInput() ?>
<!--                        <button>Submit</button>-->
                        <div class="form-group">
                            <div class="col-lg-offset-1 col-lg-11">
                                <?= Html::button('upload',
                                    ['type'=>'submit','class' => 'btn btn-primary', 'name' => 'upload-button',
                                    'onclick'=> 'uploadOnClick()' ]) ?>
                            </div>
                        </div>





                        <?php ActiveForm::end() ?>







<!--                        --><?php
                        $form = ActiveForm::begin([
                            'id' => 'registration-form',
                            'action' => '#',
                            'options' => ['class' => 'form-horizontal'],
                            'fieldConfig' => [
                                'template' => "{label}\n<div class=\"col-lg-10\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                                'labelOptions' => ['class' => 'col-lg-2 control-label'],
                            ],
                        ]); ?>
<!---->
                        <?= $form->field($mdReg, 'username')->textInput(['autofocus' => true]) ?>
                        <?= $form->field($mdReg, 'enterPassword')->passwordInput() ?>
                        <?= $form->field($mdReg, 'enterPassword_repeat')->passwordInput() ?>
                        <?= $form->field($mdProf, 'email')->textInput() ?>
                        <?= $form->field($mdProf, 'tel')->textInput() ?>
                        <?= $form->field($mdProf, 'site')->textInput() ?>
                        <?= $form->field($mdProf, 'company')->textarea() ?>
                        <?= $form->field($mdProf, 'info')->textarea() ?>
<!---->
<!--                        ]) ?>-->
<!---->
                        <div class="form-group">
                            <div class="col-lg-offset-1 col-lg-11">
                                <?= Html::button('Registration',
                                    ['class' => 'btn btn-primary', 'name' => 'login-button',
                                        'onclick' => 'registrationOnClick()']) ?>
                            </div>
                        </div>
<!---->
                        <?php ActiveForm::end(); ?>

                        <div class="col-lg-offset-1" id="userregistration-message" style="color:#999;">
                            Заполните поля
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <p>
                    <a class="btn btn-default" href="#" role="button" data-dismiss="modal" id="modal-exit">exit</a>
                </p>
            </div>
        </div>
    </div>
</div>
