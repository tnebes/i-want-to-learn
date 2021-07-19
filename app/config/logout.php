<?php declare(strict_types = 1);

   require_once 'config.php';
   session_destroy();
   unset($_SESSION);
   header('location:' . APPLICATION_PATH . 'index.php');
