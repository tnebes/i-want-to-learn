<?php declare(strict_types = 1);

   class Pages extends Controller
   {
      public function __construct()
      {
         
      }

      public function index()
      {
         // creating data         
         $this->view('pages/index');
      }

      public function about()
      {
         $this->view('pages/about');
      }

      public function error()
      {
         $this->view('pages/error');
      }


   }