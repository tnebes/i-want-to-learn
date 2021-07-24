<?php declare(strict_types = 1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <?php require_once APPROOT . '/views/includes/head.php'; ?>
</head>
<body>
   <?php require_once APPROOT . '/views/includes/navigator.php'; ?>

   <!-- page displays user information -->
   <div class="container">
      <div class="row">
         <div class="col-md-3">
         </div>
         <div class="col-md-9">
            <h1>Profile</h1>
            <p>
               This page displays <?php var_dump($data)?>'s profile.
            </p>
         </div>
      </div>
   </div>


   <?php require_once APPROOT . '/views/includes/footer.php'; ?>
   <?php require_once APPROOT . '/views/includes/javascript.php'; ?>
</body>


</html>