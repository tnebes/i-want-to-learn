<?php declare(strict_types = 1);
   require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <?php require_once 'templates/head.php'; ?>
</head>
<body>
   <?php require_once 'templates/header.php' ?>

   <div class="callout">
      <h5>Login</h5>
      <form action="<?php echo $APPLICATION_PATH; ?>authorisation.php" method="POST">
         <label for="email">Email</label>
         <input type="text" name="email" id="email">
         <label for="password">Password</label>
         <input type="password" name="password" id="password">
         <input type="submit" value="login">
         <a href="#">Forgot your password?</a>
      </form>
   </div>
   <?php require_once 'templates/footer.php' ?>
   <?php require_once 'templates/javascript.php' ?>
</body>
</html>