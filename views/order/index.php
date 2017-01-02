<?php
/**
 *    форма для новогоЗаказа
 */
//use Yii ;
//echo 'Это новый заказ...';
$dir = Yii::getAlias('@app/views/layouts/layoutParts') ;

?>
<div class="container fluid">
    <div class="row">
        <div class="col-md-12 block">
            <h3 class="header-title" style="text-align: center;">Оформление заказа</h3>
            <?php
            include  $dir . "/viewParts/newOrder_quickRegistration.php";
            ?>
        </div>
    </div>
    <!--</div>-->
    <!--<div class="container-fluid">-->
    <div class="row">
        <div class="col-md-12 block">
            <?php
            include $dir  . "/viewParts/orderForm.php";
            ?>
        </div>
    </div>
</div>

