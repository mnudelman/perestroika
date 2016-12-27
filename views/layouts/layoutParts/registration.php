<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 26.12.16
 * Time: 21:17
 */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm ;
use app\models\LoginForm ;
use app\models\UserRegistration ;
use app\models\UserProfile ;

?>
<?php
$mdReg = new UserRegistration() ;
$mdProf = new UserProfile() ;
$title = 'myRegistration' ;
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
                <div id="enter-modal-insert" >
                    <div class="site-login">
                        <p>Please fill out the following fields to login:</p>

                        <?php
                        $form = ActiveForm::begin([
                            'id' => 'registration-form',
                            'action' => '#',
                            'options' => ['class' => 'form-horizontal'],
                            'fieldConfig' => [
                                'template' => "{label}\n<div class=\"col-lg-10\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                                'labelOptions' => ['class' => 'col-lg-2 control-label'],
                            ],
                        ]); ?>

                        <?= $form->field($mdReg, 'username')->textInput(['autofocus' => true]) ?>
                        <?= $form->field($mdReg, 'password')->passwordInput() ?>
                        <?= $form->field($mdReg, 'password_repeat')->passwordInput() ?>
                        <?= $form->field($mdProf, 'email')->textInput() ?>
                        <?= $form->field($mdProf, 'site')->textInput() ?>
                        <?= $form->field($mdProf, 'company')->textarea() ?>
                        <?= $form->field($mdProf, 'info')->textarea() ?>

                        ]) ?>

                        <div class="form-group">
                            <div class="col-lg-offset-1 col-lg-11">
                                <?= Html::button('Login',
                                    ['class' => 'btn btn-primary', 'name' => 'login-button',
                                        'onclick' => 'loginOnClick()']) ?>
                            </div>
                        </div>

                        <?php ActiveForm::end(); ?>

                        <div class="col-lg-offset-1" id="enterform-message" style="color:#999;">
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
