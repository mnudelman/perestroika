<?php
/**
* список форм
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <?php
  include __DIR__ . "/views/headPart.php" ;
 ?>
<title>новый заказ</title>
</head>
<body>
<?php include __DIR__ . "/views/topPart.php"?>
<div class="container body-content">

    <?php
    include __DIR__ . "/views/formsList.php" ;
    ?>


</div>
<?php
include __DIR__ . "/views/footerPart.php" ;
?>


</body>
</html>