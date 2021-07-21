<?php declare(strict_types = 1);

   class Pages extends Controller
   {
      public function __construct()
      {
         $this->userModel = $this->model('User');
      }

      public function index()
      {
         // creating data
         $users = $this->userModel->getUsers();


         $data =
         [
            'title' => 'Pages',
            'users' => $users,
         ];
         // passing the data to the view
         
         $this->view('pages/index', $data);
      }

      public function about()
      {
         $this->view('pages/about');
      }


   }