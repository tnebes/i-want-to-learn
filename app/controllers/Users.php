<?php

declare(strict_types=1);

class Users extends Controller
{
   // NOTE: TODO: Users have been removed from the navigator. Fix this once a proper solution has been found.
   public function __construct()
   {
      $this->userModel = $this->model('User');
   }
   
   public function index() : void
   {
      if (!isLoggedIn())
      {
         // TODO:
         redirect('/');
         return;
      }
      $data = [];
      if (isAdmin())
      {
         $data['admin'] = true;
         $data['users'] = $this->userModel->getUsersPrivate();
      }
      else
      {
         $data['admin'] = false;
         $data['users'] = $this->userModel->getUsersPublic();
      }
      $this->view('users/index', $data);
   }

   public function login() : void
   {
      // TODO: redirect the user away from this page when they are already logged in.
      // TODO: redirect does not work after logging in.
      if (isLoggedIn())
      {
         redirect('/');
         return;
      }
      $data =
         [
            'Title' => 'Login page',
            'username' => '',
            'password' => '',
            'usernameError' => '',
            'passwordError' => ''
         ];

      if ($_SERVER['REQUEST_METHOD'] === 'POST')
      {
         // sanitise post data
         $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

         $data =
            [
               'username' => trim($_POST['username']),
               'password' => trim($_POST['password']),
               'usernameError' => '',
               'passwordError' => ''
            ];

         if (empty($data['username']))
         {
            $data['usernameError'] = 'Username is required.';
         }
         if (empty($data['password'])) 
         {
            $data['passwordError'] = 'Password is required.';
         }

         if (empty($data['usernameError']) && empty($data['passwordError'])) 
         {
            $loggedInUser = $this->userModel->login($data['username'], $data['password']);
            if ($loggedInUser)
            {
               $this->createUserSession($loggedInUser);
            }
            else
            {
               $data['passwordError'] = 'Invalid username or password.';
               $this->view('users/login', $data);
               // TODO: check whether its necessary to return
               return;
            }
         }
      }
      else 
      {
         $data =
            [
               'username' => '',
               'password' => '',
               'usernameError' => '',
               'passwordError' => ''
            ];
      }
      $this->view('users/login', $data);
   }

   public function createUserSession($user): void
   {
      $_SESSION['user_id'] = $user->id;
      $_SESSION['username'] = $user->username;
      $_SESSION['email'] = $user->email;
      $_SESSION['role'] = $user->role;
   }

   public function register() : void
   {
      if (!isAdmin() && isLoggedIn())
      {
         // TODO: add a better way of redirecting the user
         redirect('/');
         return;
      }
      
      $data =
         [
            'Title' => 'Register page',
            'username' => '',
            'email' => '',
            'password' => '',
            'confirmPassword' => '',
            'usernameError' => '',
            'emailError' => '',
            'passwordError' => '',
            'confirmPasswordError' => '',
         ];

      if ($_SERVER['REQUEST_METHOD'] == 'POST') 
      {
         // TODO: check whether this is necessary
         if (isset($_POST['submit'])) 
         {
            //sanitise POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data =
               [
                  'username' => trim($_POST['username']),
                  'email' => trim($_POST['email']),
                  'password' => trim($_POST['password']),
                  'confirmPassword' => trim($_POST['confirmPassword']),
                  'usernameError' => '',
                  'emailError' => '',
                  'passwordError' => '',
                  'confirmPasswordError' => '',
               ];

            $nameValidation = "/^[a-zA-Z0-9]*$/";
            $passwordValidation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";

            if (empty($data['username'])) 
            {
               $data['usernameError'] = 'Username is required.';
            } elseif (!preg_match($nameValidation, $data['username'])) 
            {
               $data['usernameError'] = 'Username must contain only letters and numbers.';
            }

            if (empty($data['email'])) 
            {
               $data['emailError'] = 'Email is required.';
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) 
            {
               $data['emailError'] = 'Email is not valid.';
            } else {
               if ($this->userModel->findUserByEmail($data['email'])) 
               {
                  $data['emailError'] = 'Email is already in use.';
               }
            }

            //validate password
            if (empty($data['password'])) 
            {
               $data['passwordError'] = 'Password is required.';
            } elseif (strlen($data['password']) < 7) 
            {
               $data['passwordError'] = 'Password must be at least 8 characters.';
            } elseif (preg_match($passwordValidation, $data['password'])) 
            {
               $data['passwordError'] = 'Password must contain at least one numeric value';
            }

            //validate confirm password
            if (empty($data['confirmPassword'])) 
            {
               $data['confirmPasswordError'] = 'Confirm password is required.';
            } elseif ($data['password'] != $data['confirmPassword']) 
            {
               $data['confirmPasswordError'] = 'Password and confirm password must match.';
            }

            // make sure that errors are empty
            if (empty($data['usernameError']) && empty($data['emailError']) && empty($data['passwordError']) && empty($data['confirmPasswordError'])) 
            {
               // has the password
               $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
               // register user
               if ($this->userModel->register($data)) 
               {
                  header('location: ' . URLROOT . '/users/login');
                  // TODO: check whether it is necessary to return
                  return;
               } 
               else 
               {
                  die('Something went wrong.');
               }
            }
         }
      }
      $this->view('users/register', $data);
   }

   public function logout(): void
   {
      unset($_SESSION['user_id']);
      unset($_SESSION['username']);
      unset($_SESSION['email']);
      unset($_SESSION['role']);
      header('location: ' . URLROOT . '/users/login');
   }

   public function profile() : void
   {
      // gets the arguments from the APP.php call
      $data = func_get_args();
      if (!$data)
      {
         // TODO: ehh redirection
         return;         
      }
      if (isset($data))
      {
         $user = $this->userModel->getSingleUserById((int) $data[0]);
         $this->view('users/profile', $user);
         unset($data[0]);
         return;
      }
   }

   public function ban() : void
   {
      // expected arguments when passed include true to indicate immediate deletion without any additional confirmation
      // TODO: once a user has been banned and the admin has confirmed the ban, the banned state of the user
      // is not immediately synced with the database. The DB gives faulty data.
      /**
       * Massive TODO: make sure that the data passed to the view are 100% up to date. For now, the banned state of the user depends on the speed
       * of the mySQL server and php.
       */

      $data = func_get_args();
      if (!$data)
      {
         // TODO: ehh redirection
         return;
      }
      $user = $this->userModel->getSingleUserById((int) $data[0]);
      unset($data[0]);
      
      // if all is set, ban the user
      if (isset($data[1]))
      {
      // I have a feeling this is a terrible way to do this.
      $data[1] = filter_var($data[1], FILTER_VALIDATE_BOOL);
         if (isset($data[1]) && $data[1] == true && isAdmin())
         {
            if ($user->banned != 0)
            {
               unset($data[1]);
               $this->userModel->unbanUserById((int) $user->id);
            }
            else
            {
               unset($data[1]);
               $this->userModel->banUserById((int) $user->id);
            }
         }
         else if (isset($data[1]) && !$data[1])
         {
            
         }
      }
      $this->view('users/ban', $user);
      return;
   }
}
