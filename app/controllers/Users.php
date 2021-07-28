<?php

declare(strict_types=1);

class Users extends Controller
{
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
               createUserSession($loggedInUser);
               redirect('/');
               return;
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
                  'email' => strtolower(trim($_POST['email'])),
                  'password' => trim($_POST['password']),
                  'confirmPassword' => trim($_POST['confirmPassword']),
                  'usernameError' => '',
                  'emailError' => '',
                  'passwordError' => '',
                  'confirmPasswordError' => '',
               ];

            // add check for whether the username is taken
            $data['usernameError'] = validateUsername($data['username']);
            $data['emailError'] = validateEmail($data['email'], $this->userModel);
            $data['passwordError'] = validatePassword($data['password']);
            $data['confirmPasswordError'] = validateConfirmPassword($data['confirmPassword'], $data['password']);

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
      if (!isLoggedIn())
      {
         return;
      }
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
      if (!isAdmin())
      {
         // TODO: add redirect
         die('You are not an admin.');
      }
      // gets the arguments from the APP.php call
      $data = func_get_args();
      if (!$data)
      {
         // TODO: redirect
         die('Some arguments required.');
      }
      $userId = (int) $data[0];
      $user = $this->userModel->getSingleUserById($userId);
      $data = 
      [
         'user' => $user,
         'usernameError' => '',
         'emailError' => '',
         'registrationDateError' => '',
         'roleError' => '',
         'lastLoginError' => '',
         'bannedError' => '',
         'dateBannedError' => ''
      ];
      
      if ($_SERVER['REQUEST_METHOD'] == 'POST')
      {
         $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
         // add to $data array another array
         $data['username'] = trim($_POST['username']);
         $data['email'] = trim($_POST['email']);
         $data['registrationDate'] = $_POST['registrationDate'];
         $data['role'] = trim($_POST['role']);
         $data['lastLogin'] = $_POST['lastLogin'];
         if (isset($_POST['banned']))
         {
            $data['banned'] = $_POST['banned'];
         }
         else
         {
            $data['banned'] = null; // TODO: fix this cursed workaround
         }
         $data['dateBanned'] = $_POST['dateBanned'];

         if (isset($_POST['update']))
         {
            //TODO: there must be a better way to do this
            $updatedUser = clone $user;
            $updatedUser->username = $data['username'];
            $updatedUser->email = $data['email'];
            $updatedUser->registrationDate = $data['registrationDate'];            
            $updatedUser->role = $data['role'];
            $updatedUser->lastLogin = $data['lastLogin'];
            $updatedUser->banned = $data['banned'];
            $updatedUser->dateBanned = $data['dateBanned'];

            $data['usernameError'] = validateUsername($updatedUser->username);
            $data['emailError'] = validateEmail($updatedUser->email, $this->userModel);
            $data['registrationDateError'] = validateDate($updatedUser->registrationDate);
            $data['roleError'] = validateRole($updatedUser->role);
            $data['lastLoginError'] = validateDate($updatedUser->lastLogin);
            $data['bannedError'] = validateBanned($updatedUser->banned);
            $data['dateBannedError'] = validateDate($updatedUser->dateBanned);
            
            // check if the errors are empty
            if (empty($data['usernameError']) && empty($data['emailError']) && empty($data['registrationDateError']) && empty($data['roleError']) && empty($data['lastLoginError']) && empty($data['bannedError']) && empty($data['dateBannedError']))
            {
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
      }
      $this->view('users/update', $data);
   }

   public function delete() : void
   {
      // TODO: add a data section for explaining why a user cannot be deleted.
      if (!isAdmin())
      {
         die('You are not an admin');
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
