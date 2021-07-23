<?php declare(strict_types = 1);

   function redirect(string $path) : void
   {
      header('Location: ' . URLROOT . $path);
   }