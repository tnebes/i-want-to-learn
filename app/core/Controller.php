<?php declare(strict_types = 1);

   class Controller
   {
      public function model(string $model)
      {
         require_once '../app/models/' . $model . '.php';
         return new $model();
      }

      // TODO: why does this folder structure require ../app to be in the path?
      public function view($view, $data = [])
      {
         if (file_exists('../app/views/' . $view . '.php'))
         {
            require_once '../app/views/' . $view . '.php';
         }
         else
         {
            require_once '../app/views/error.php';
         }
      }
   }