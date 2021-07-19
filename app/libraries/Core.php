<?php declare(strict_types = 1);
   //Core App Class
   class Core
   {
      protected $currentController = 'Users';
      protected $currentMethod = 'index';
      protected $params = [];

      public function __construct()
      {
         $url = $this->getUrl();
         // classes needs to be capitalised

         //TODO: if the url is not provided?

         if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php'))
         {
            // sets a new controller
            $this->currentController = ucwords($url[0]);
            unset($url[0]);
         }
         // require the controller for the user's url
         require_once('../app/controllers/' . $this->currentController . '.php');
         $this->currentController = new $this->currentController();

         if (isset($url[1]))
         {
            // searches for a method in the class
            if (method_exists($this->currentController, $url[1]))
            {
               // sets a new method 
               $this->currentMethod = $url[1];
               unset($url[1]);
            }
         }

         // get the parameters from the url
         $this->params = $url ? array_values($url) : [];

         // call a callback with array of parameters
         call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
                 
      }

      public function getUrl() : array
      {
         if (isset($_GET['url']))
         {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
         }
         return [];
      }
   } 