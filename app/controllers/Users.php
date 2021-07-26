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
            }
            elseif (!preg_match($nameValidation, $data['username'])) 
            {
               $data['usernameError'] = 'Username must contain only letters and numbers.';
            }

            if (empty($data['email'])) 
            {
               $data['emailError'] = 'Email is required.';
            }
            elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) 
            {
               $data['emailError'] = 'Email is not valid.';
            }
            else
            {
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
      if (!isAdmin())
      {
         // TODO: redirect
         return;
      }

      $data = func_get_args();
      if (!$data)
      {
         // TODO: ehh redirection
         return;
      }
      $user = $this->userModel->getSingleUserById((int) $data[0]);
      unset($data[0]);
      if ($_SERVER['REQUEST_METHOD'] == 'POST')
      {
         $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

         if (isset($_POST['confirm']) && filter_var($_POST['confirm'], FILTER_VALIDATE_BOOL))
         {
            if ($user->banned)
            {
               $this->userModel->unbanUserById((int) $user->id);
            }
            else
            {
               $this->userModel->banUserById((int) $user->id);
            }
            header('Refresh:0');
            return;
         }
      }
      
      $this->view('users/ban', $user);
      return;
   }

   public function update() : void
   {
      // gets the arguments from the APP.php call
      $data = func_get_args();
      if (!$data)
      {
         // TODO: redirect
         return;
      }
      $userId = (int) $data[0];
      $user = $this->userModel->getSingleUserById($userId);
      unset($data[0]);
      
      if ($_SERVER['REQUEST_METHOD'] == 'POST')
      {
         $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
         if (filter_var($_POST['update']))
         {
            //TODO: there must be a better way to do this
            $updatedUser = new User();
            $updatedUser->id = $user->id;
            $updatedUser->username = $_POST['username'];
            $updatedUser->email = $_POST['email'];
            $updatedUser->registrationDate = $_POST['registrationDate'];            
            $updatedUser->role = $_POST['role'];
            $updatedUser->lastLogin = $_POST['lastLogin'];
            $updatedUser->banned = $_POST['banned'];
            $updatedUser->dateBanned = $_POST['dateBanned'];

            if ($this->userModel->updateUser($updatedUser))
            {
               header('location: ' . URLROOT . '/users/profile/' . $userId);
               return;
            }
            else
            {
               // TODO: lmao
               die('Something went wrong.');
            }
         }
      }

      $this->view('users/update', $user);
   }

   public function delete() : void
   {
      // TODO: add a data section for explaining why a user cannot be deleted.
      if (!isAdmin())
      {
         return;
      }

      $data = func_get_args();
      if (!$data)
      {
         return;
      }
      $user = $this->userModel->getSingleUserById((int) $data[0]);
      unset($data[0]);
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      if ($_SERVER['REQUEST_METHOD'] == 'POST')
      {
         if (isset($_POST['confirm']) && filter_var($_POST['confirm'], FILTER_VALIDATE_BOOL))
         {
            $userId = (int) $user->id;
            $this->userModel->deleteUserById($userId);
            // TODO: temporary redirect until i figure out how to do it properly
            header('location: ' . URLROOT . '/users');
            return;
         }
      }
      $this->view('users/delete', $user);      
   }

}
