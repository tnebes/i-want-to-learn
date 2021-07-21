<?php declare(strict_types = 1);

   // constant for the database connection
   define('DB_HOST', 'localhost');
   define('DB_NAME', 'iwtl');
   define('DB_USER', 'edunova');
   define('DB_PASS', 'edunova');

   // constants for the app root
   // double dirname ensures we got back to the root
   // since we are two levels deep
   define('APPROOT', dirname(dirname(__FILE__)));   

   // constants for the url root
   define('URLROOT', 'http://iwtl.com');

   define('APP_NAME', 'IWTL');

?>