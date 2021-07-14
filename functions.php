<?php declare(strict_types = 1);

   require_once 'config.php';

   function isAuthorised() : bool
   {
      if (isset($_SESSION['authorised']))
      {
         return true;
      }
      return false;
   }

   function checkEmailPassword(string $email, string $password) : int
   {
      // PHP nije lijep - T. Jakopec, 2021.
      global $users; // TODO: stop using this!!! -- use a parameter!!! this is terrible
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
      $_SESSION['authorised'] = $email;
      return 0;
   }