<?php declare(strict_types = 1);

   class Pages extends Controller
   {
      public function __construct()
      {
         // empty
      }

      public function index() : void
      {   
         $this->view('pages/index');
      }

      public function about() : void 
      {
         $this->view('pages/about');
      }

      public function error() : void
      {
         $this->view('pages/error');
      }


   }