<?php declare(strict_types = 1);

   /**
    * @param $username
    * @return 0 for valid, 1 for username already exists, 2 for no username, 3 for invalid username
    */
   function validateUsername(string $username) : int
   {
      // TODO: if the username already exists...
      $nameValidation = "/^[a-zA-Z0-9]*$/";
      if (!$username) 
      {
         return 2;
      }
      elseif (!preg_match($nameValidation, $username)) 
      {
         return 3;
      }
      return 0;
   }

   function validateEmail(string $email) : int
   {

   }

   function validatePassword(string $password) : int
   {

   }

   function validateDate(string $date) : int
   {

   }

   function validateRole(string $role) : int
   {

   }

   function validateBanned(string $banned) : int
   {

   }