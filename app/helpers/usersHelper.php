<?php declare(strict_types = 1);

   /**
    * @param $username
    * @return string for an error if exists. Empty string if no error.
    */
   function validateUsername(string $username, $userModel) : string
   {
      $nameValidation = "/^[a-zA-Z0-9]*$/";
      if ($userModel->findUserByUsername($username))
      {
         return 'Username already exists';
      }
      elseif (!$username)
      {
         return 'Username is required.';
      }
      elseif (!preg_match($nameValidation, $username))
      {
         return 'Username can only contain letters and numbers.';
      }
      elseif (strlen($username) < 3)
      {
         return 'Username must be at least 3 characters long.';
      }
      return '';
   }

   function validateEmail(string $email, $userModel) : string
   {
      if (!$email) 
      {
         return 'Email is required.';
      }
      elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
      {
         return 'Email is not valid.';
      }
      elseif ($userModel->findUserByEmail($email))
      {
         return 'Email is already in use.';
      }
      return '';
   }

   function validatePassword(string $password) : string
   {
      $passwordValidation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";
      if (!$password) 
      {
         return 'Password is required.';
      }
      elseif (strlen($password) < 7) 
      {
         return 'Password must be at least 7 characters.';
      }
      elseif (preg_match($passwordValidation, $password)) 
      {
         return 'Password must contain at least one numeric value';
      }
      return '';
   }

   function validateConfirmPassword(string $confirmPassword, string $password) : string
   {
      if (!$confirmPassword) 
      {
         return 'Confirm password is required.';
      }
      elseif ($confirmPassword != $password) 
      {
         return 'Password and confirm password must match.';
      }
      return '';
   }

   function validateDate(string $date) : string
   {
      $dateValidation = "/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/";
      if (!$date)
      {
         return 'Date is required.';
      }
      elseif (!preg_match($dateValidation, $date))
      {
         return 'Date is not valid.';
      }
      return '';
   }

   function validateRole(string $role) : string
   {
      $roleValidation = "/^[0-9]*$/";
      if ($role == '') // TODO: can't use empty because it registers 0 as empty.
      {
         return 'Role is required.';
      }
      elseif (!preg_match($roleValidation, $role))
      {
         return 'Role must be a number from 0 to 9';
      }
      return '';
   }

   function validateBanned(?string $banned) : string // sometimes null is passed in
   {
      return '';
   }