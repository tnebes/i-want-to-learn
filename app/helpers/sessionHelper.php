<?php declare(strict_types = 1);

   session_start();

   function isLoggedIn() : bool
   {
      return isset($_SESSION['user_id']);
   }

   function isAdmin() : bool
   {
      if (isset($_SESSION['role']))
      {
         return $_SESSION['role'] == 1;
      }
      return false;
   }

   function createUserSession($user): void
   {
      $_SESSION['user_id'] = $user->id;
      $_SESSION['username'] = $user->username;
      $_SESSION['email'] = $user->email;
      $_SESSION['role'] = $user->role;
   }
