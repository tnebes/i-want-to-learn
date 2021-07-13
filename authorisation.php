<?php declare(strict_types = 1);

   require_once 'functions.php';

   if (!(isset($_POST['email']) && isset($_POST['password'])))
   {
      header('location:' . $APPLICATION_PATH . 'index.php');
   }

   $email = $_POST['email'];
   $password = $_POST['password'];

   if (checkEmailPassword($email, $password) == 0)
   {
      setAuthorised($_POST['email']);
      header('location:' . $APPLICATION_PATH . 'index.php');
   }
   else
   {
      header('location:' . $APPLICATION_PATH . 'login.php');
   }

?>