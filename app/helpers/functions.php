<?php declare(strict_types = 1);

   function redirect(string $path) : void
   {
      header('Location: ' . URLROOT . $path);
   }

   function debugVar(mixed $var) : void
   {
      echo '<pre>';
      var_dump($var);
      echo '</pre>';
   }