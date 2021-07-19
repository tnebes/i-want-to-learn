<?php declare(strict_types = 1);

   class Users extends Controller
   {
      public function __construct()
      {
         $this->userModel = $this->model('User');
      }

      public function index() : void
      {
         $users = $this->userModel->getUsers();
         $data = 
         [
            'title' => 'Users',
            'name' => $users
         ];
         $this->view('users/index', $data);
      }

      public function about() : void
      {
         $this->view('users/about');
      }

   }
