<?php declare(strict_types = 1);

   session_start();
   session_destroy();
   unset($_SESSION);
   header('location:' . $APPLICATION_PATH . 'index.php');
