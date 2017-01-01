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

?>
<?php
$title = 'LOGIN' ;
$model = new LoginForm() ;
$this->title = 'myLogin' ;
?>
<div class="modal fade" id="enter-form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                            'id' => 'login-form',
                            'action' => '#',
                            'options' => ['class' => 'form-horizontal'],
                            'fieldConfig' => [
                                'template' => "{label}\n<div class=\"col-lg-10\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                                'labelOptions' => ['class' => 'col-lg-2 control-label'],
                            ],
                        ]); ?>

                        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                        <?= $form->field($model, 'password')->passwordInput() ?>

                        <?= $form->field($model, 'rememberMe')->checkbox([
                            'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
                        ]) ?>

                        <div class="form-group">
                            <div class="col-lg-offset-1 col-lg-11">
                                <?= Html::button('Login',
                                    ['class' => 'btn btn-primary', 'name' => 'login-button',
                                        'onclick' => 'loginOnClick()']) ?>
                            </div>
                        </div>

                        <?php ActiveForm::end(); ?>

                        <div class="col-lg-offset-1" name="form-messages" style="color:#ff0000;">
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
