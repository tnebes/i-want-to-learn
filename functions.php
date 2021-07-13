<?php declare(strict_types = 1);

   function isAuthorised() : bool
   {
      if (isset($_SESSION['authorised']))
      {
         return true;
      }
      return false;
   }