<?php
/*
  * Главная (домашняя) страница
  */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include __DIR__ . "/views/headPart.php" ;
    ?>
    <title>пересторойка</title>
</head>


<body>
<?php include __DIR__ . "/views/topPart.php"?>
<div class="container body-content">
    <?php
    include __DIR__ . "/views/homePage.php" ;
    ?>

</div>
<?php
include __DIR__ . "/views/footerPart.php" ;
?>

</body>
</html>