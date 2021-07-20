<?php declare(strict_types = 1);

   class App
   {
      protected $currentController = 'Pages';
      protected $currentAction = 'index';
      protected $currentParams = [];

      /**
       * Constructor
       */
      public function __construct()
      {
         print_r($this->getUrl());
      }

      /**
       * Get the URL for the current request.
       */
      public function getUrl()
      {
         print_r($_GET);
         if (isset($_GET['url']))
         {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            return $url;
         }
      }
   }
