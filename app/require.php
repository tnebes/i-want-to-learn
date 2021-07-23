<?php declare(strict_types = 1);
   // Require the files that represent the core of the application
   require_once 'core/config.php';
   require_once 'core/App.php';
   require_once 'core/Controller.php';
   require_once 'core/Database.php';
   require_once 'helpers/sessionHelper.php';
   require_once 'helpers/userHelper.php';
   require_once 'helpers/functions.php';

   // Instantiate the App class
   $app = new App();
   
