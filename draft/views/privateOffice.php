<?php
/**
 * Личный кабинет
 * Time: 12:37
 */
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 block">
<!--            <div class="list-group">-->
<!--                <a href="#" class="list-group-item active">-->
<!--                    личный кабинет-->
<!--                </a>-->
<!--                <a href="#" class="list-group-item">Новый заказ</a>-->
<!--                <a href="#" class="list-group-item">Мои услуги</a>-->
<!--                <a href="#" class="list-group-item">Мои заказы</a>-->
<!--            </div>-->

            <ul class="nav nav-pills nav-stacked">
                <li>
                    <a href="#" class="list-group-item">Новый заказ</a>
                </li>
                <li>
                    <a href="#" class="list-group-item">Мои услуги</a>
                </li>
                <li>
                    <a href="#" class="list-group-item">Мои заказы</a>
                </li>
            </ul>


         </div>
         <div class="col-md-10 block">
            <div class="row">
                <?php
                include __DIR__ . "/newOrderSimple.php";
//                include __DIR__ . "/newOrder.php";
//                  include __DIR__ . "/developersList.php";
//                  include __DIR__ . "/developerWorks.php";


                ?>
            </div>
        </div>
    </div>
</div>