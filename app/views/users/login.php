<?php declare(strict_types = 1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <?php require_once APPROOT . '/views/includes/head.php'; ?>
</head>
<body>
   <div class="container">
      <?php require_once APPROOT . '/views/includes/navigator.php'; ?>
      <div class="callout form">
      <div class="wrapper-login">
         <h2>Sign in</h2>

         <form action="<?php echo URLROOT; ?>/users/login" method ="POST">
               <input type="text" placeholder="Username *" name="username">
               <span class="invalidFeedback">
                  <?php echo $data['usernameError']; ?>
               </span>

               <input type="password" placeholder="Password *" name="password">
               <span class="invalidFeedback">
                  <?php echo $data['passwordError']; ?>
               </span>

               <button class="button" id="submit" type="submit" value="submit">Submit</button>

               <p class="options">Not registered ? <a href="<?php echo URLROOT; ?>/users/register">Create an account.</a></p>
         </form>
      </div>
   </div>

   <div class="callout primary" id="login-data">
      <h5>Login data</h5>
      <pre>
username: <code>tnebes</code> 
password: <code>letmeinside1</code> (admin role)
<hr />
username: <code>normie</code>
password: <code>letmeinside1</code> (user role)
      </pre>
   </div>
</div>

<?php require_once APPROOT . '/views/includes/footer.php'; ?>
<?php require_once APPROOT . '/views/includes/javascript.php'; ?>

</body>


</html>