<?php
/**
 * форма "Список исполнителей"
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include __DIR__ . "/views/headPart.php" ;
    ?>
    <title>Исполнители</title>
</head>
<body>
<?php include __DIR__ . "/views/topPart.php"?>
<div class="container body-content">

    <?php
    include __DIR__ . "/views/developersList.php" ;
    ?>


</div>
<?php
include __DIR__ . "/views/footerPart.php" ;
?>


</body>
</html>