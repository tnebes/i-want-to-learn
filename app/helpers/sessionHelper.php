<?php declare(strict_types = 1);

   session_start();

   function isLoggedIn() : bool
   {
      return isset($_SESSION['user_id']);
   }