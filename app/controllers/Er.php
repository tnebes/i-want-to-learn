<?php declare(strict_types = 1);

   class Er extends Controller
   {
      public function __construct()
      {
         
      }

      public function index() : void
      {
         if(isLoggedIn())
         {
            $this->view('er/index');
         }
         else
         {
            die('You need to be logged in to view this page.');
         }
      }

      public function image() : void
      {
         if(isLoggedIn())
         {
            $this->view('er/image');
         }
         else
         {
            die('You need to be logged in to view this page.');
         }
      }
      
   }