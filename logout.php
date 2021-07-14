<?php declare(strict_types = 1);

   // why doesn't this work?

   // if (isset($_SESSION['authorised']))
   // {
   //    session_start();
   //    session_destroy();
   //    unset($_SESSION);
   //    header('location:' . $APPLICATION_PATH . 'index.php');
   // }

   session_start();
   session_destroy();
   unset($_SESSION);
   header('location:' . $APPLICATION_PATH . 'index.php');
