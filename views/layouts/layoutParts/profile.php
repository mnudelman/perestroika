<?php
/**
 * Редактировать профиль
 * Time: 21:17
 */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\models\LoginForm;
use app\models\UserProfile;
use app\models\UploadForm;
use yii\widgets\Pjax;
use app\service\PageItems ;
//use Yii ;
?>
<?php
$userIsGuest = Yii::$app->user->isGuest ;
if ($userIsGuest) {
    $profile = new UserProfile();
}else {
    $userid = Yii::$app->user->identity->id ;
    $profile = UserProfile::findOne(['userid' => $userid]) ;

}
//$profile->email = '123@y.ru' ;
$mdUpload = new UploadForm();
$title = 'ProfileEdit';
$urlUpload = Url::to(['site/upload']) ;
$uploadFormId = "profile-upload-form" ;
$avatarImgId = 'profile-avatar-img' ;
$avatarImgName = $profile->avatar ;
$avatarImgName = (empty($avatarImgName)) ? 'people.png' : $avatarImgName ;




$titleTab = PageItems::getItemText(['user','forms','profileForm','title']) ;
$title = $titleTab['text'] ;
$ruleTitleTab = PageItems::getItemText(['user','forms','profileForm','rules','title']) ;
$ruleTitle = $ruleTitleTab['text'] ;
$ruleContentTab = PageItems::getItemText(['user','forms','profileForm','rules','content']) ;
$ruleContent = $ruleContentTab['text'] ;
$buttonsTab = PageItems::getItemText(['user','buttons']) ;
$saveBt = $buttonsTab['saveProfile'] ;
$restoreBt = $buttonsTab['restoreProfile'] ;
















?>

<div class="modal fade" id="profile-form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="enter-modal-title"><?= Html::encode($title) ?></h4>
            </div>
            <div class="modal-body" id="modal-body">

                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingOne">
                            <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#profile-form-collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <?=$ruleTitle ?><span class="caret"></span>
                                </a>
                            </h4>
                        </div>
                        <div id="profile-form-collapseOne" class="panel-collapse collapse in rule-content" role="tabpanel" aria-labelledby="headingOne">
                            <div class="panel-body">
                                <?=$ruleContent?>
                            </div>
                        </div>
                    </div>

                </div>






                <div id="enter-modal-insert">
                    <div class="site-login">

                        <!---->
                        <?php
                        $img = Html::img('@web/images/avatars/' . $avatarImgName  ,
                            ['class'=>'img-responsive img-thumbnail','alt'=>'this is picture',
                                'width'=>'72px','id' => $avatarImgId]) ;
                        echo Html::tag('div',$img);
                        ?>

                        <?php $form = ActiveForm::begin([
                            'id' => $uploadFormId,
                            'action' => '#',
                            'options' => ['enctype' => 'multipart/form-data']] ) ;
                        ?>
                        <?= $form->field($mdUpload, 'imageFile')->fileInput() ?>
                        <!--                        <div class="form-group">-->
                        <div class="col-lg-11">
                            <?= Html::button('upload',
                                ['type'=>'button','class' => 'btn btn-primary', 'name' => 'upload-button',
                                    'onclick'=> 'uploadOnClick('
                                        .'"' . $uploadFormId .'","' . $urlUpload . '","' . $avatarImgId . '")' ]) ?>
                        </div>
                        <!--                        </div>-->
                        <?php ActiveForm::end() ?><br><br>
                        <?php
                        $form = ActiveForm::begin([
                            'id' => 'profile-form',
                            'action' => '#',
                            'options' => ['class' => 'form-horizontal'],
                            'fieldConfig' => [
                                'template' => "{label}\n<div class=\"col-lg-10\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                                'labelOptions' => ['class' => 'col-lg-2 control-label'],
                            ],
                        ]);
                        ?>
                        <!---->
                        <?= $form->field($profile, 'email')->textInput() ?>
                        <?= $form->field($profile, 'tel')->textInput() ?>
                        <?= $form->field($profile, 'site')->textInput() ?>
                        <?= $form->field($profile, 'company')->textarea() ?>
                        <?= $form->field($profile, 'info')->textarea() ?>
                        <!---->
                        <!--                        ]) ?>-->
                        <!---->
                        <div class="form-group">
                            <div class="col-lg-offset-1 col-lg-11">
                                <?= Html::button($saveBt,
                                    ['class' => 'btn btn-primary', 'name' => 'login-button',
                                        'onclick' => 'profileOnClick()']) ?>
                                <?= Html::button($restoreBt,
                                    ['class' => 'btn btn-danger', 'name' => 'restore-button',
                                        'onclick' => 'profileOnClick(1)']) ?>
                            </div>
                        </div>
                        <!---->
                        <div class="col-lg-offset-1" name="form-messages" style="color:#ff0000;">
                        </div>
                        <div class="form-messages-success" name="form-messages-success" >

                        </div>
                        <div class="form-messages-error" name="form-messages-error" >

                        </div>

                        <?php ActiveForm::end(); ?>

                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <p>
<!--                    <a class="btn btn-default" href="#" role="button" data-dismiss="modal" id="modal-exit">exit</a>-->
                </p>
            </div>
        </div>
    </div>
</div>
