<?php declare(strict_types = 1);
   
   class Controller
   {
      public function model(string $model)
      {
         // require the model file
         require_once '../app/models/' . $model . '.php';
         return new $model();
      }

      // TODO: how does this cursed thing work?
      public function view(string $view, array $data = []) : void
      {
         if (file_exists('../app/views/' . $view . '.php'))
         {
            // require the view file
            require_once '../app/views/' . $view . '.php';
         }
         else
         {
            die('View ' . $view . ' not found!');
         }
      }
   }
