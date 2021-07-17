<?php declare(strict_types = 1);
   require_once '../config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <?php require_once '../templates/head.php'?>
</head>
<body>
   <?php require_once '../templates/header.php'?>
   <? foreach ($_SESSION['myTestData'] as $value)
   {
      echo $value;
      echo '<br>';
   }
   ?>
   <?php require_once '../templates/footer.php'?>
   <?php require_once '../templates/javascript.php'; ?>
</body>
</html>
