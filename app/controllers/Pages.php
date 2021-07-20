<?php declare(strict_types = 1);

   class Pages extends Controller
   {
      public function __construct()
      {

      }

      public function index()
      {
         // creating data
         $data =
         [
            'title' => 'Pages',
            'content' => 'Pages'
         ];
         // passing the data to the view
         
         $this->view('pages/index', $data);
      }

      public function about()
      {
         $this->view('pages/about');
      }


   }