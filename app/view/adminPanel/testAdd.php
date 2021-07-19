<?php declare(strict_types = 1);

   require_once '../config/config.php';

   $_SESSION['myTestData'] = [];
   for ($i = 0; $i < 10; $i++)
   {
      $_SESSION['myTestData'][] = rand(0, 100);
   }
   header('location: show.php');