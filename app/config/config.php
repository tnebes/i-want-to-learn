<?php declare(strict_types = 1);

   // TODO: single entry point

   require_once 'functions.php';

   session_start();

   define('APPLICATION_ROOT', dirname(dirname(__DIR__)));
   define('APPLICATION_PATH', 'http://iwtl.com/');
   define('APPLICATION_TITLE', 'I Want To Learn');
   define('DB_HOST', 'localhost');
   define('DB_USER', 'edunova');
   define('DB_PASS', 'edunova');
   define('DB_NAME', 'iwtl');

   echo __FILE__;

   $users =
   [
      'oper@edunova.hr' => 'o'
   ];