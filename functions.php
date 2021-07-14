<?php declare(strict_types = 1);

   require_once 'config.php';

   function isAuthorised() : bool
   {
      if (session_id() === '')
      {
         session_start();
      }   

      if (isset($_SESSION['authorised']))
      {
         return true;
      }
      return false;
   }

   function checkEmailPassword(string $email, string $password) : int
   {
      global $users;
      foreach ($users as $DBemail => $DBpassword)
      {
         if ($DBemail == $email && $DBpassword == $password)
         {
            return 0; // user and email correct
         }
      }
      return -1; // no such user or email      
   }

   function setAuthorised(string $email) : int
   {
      if (session_id() === '')
      {
         session_start();
      }   
      $_SESSION['authorised'] = $email;
      return 0;
   }