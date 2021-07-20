<?php declare(strict_types = 1);

   class App
   {
      protected $currentController = 'Pages';
      protected $currentMethod = 'index';
      protected $currentParams = [];

      /**
       * Constructor
       */
      public function __construct()
      {
         $url = $this->getUrl();

         // if the get parameter is empty, redirect to public/index.php
         // BUG: if the url is /public/index, the URL array contains only 1 element
         // TODO: find a better solution
         if (!isset($url[0]))
         {
            die();
         }

         // Controllers need to be capitalised
         if (file_exists('../app/controllers/' . ucwords($url[0]) . '.php'))
         {
            // sets a new controller
            $this->currentController = ucwords($url[0]);
            unset($url[0]);
         }

         // Requiring the controller and instantiating it
         require_once '../app/controllers/' . $this->currentController . '.php';
         $this->currentController = new $this->currentController();

         if (isset($url[1]))
         {
            if (method_exists($this->currentController, $url[1]))
            {
               $this->currentMethod = $url[1];
               unset($url[1]);
            }
         }

         // Assigning the rest of the URL to the params array
         $this->currentParams = $url ? array_values($url) : [];

         // And calling the params as well
         call_user_func_array([$this->currentController, $this->currentMethod], $this->currentParams);
      }

      /**
       * Get the URL for the current request.
       */
      public function getUrl()
      {
         if (isset($_GET['url']))
         {
            // get the url from the $_GET
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            return $url;
         }
      }
   }
