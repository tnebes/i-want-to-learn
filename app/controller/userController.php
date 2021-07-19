<?php declare(strict_types = 1);

   require_once '../config/config.php';
   require_once 'baseController.php';

   class userController extends BaseController
   {
      public function __construct(?stdClass $entity)
      {
         $this->setEntity($entity);
      }

      // implement protected methods 
      
      public function getData() : array
      {
         return $_SESSION['users'];
      }

      public function create() : void
      {
         $_SESSION['users'][] = $this->getEntity();
      }

      public function delete() : void
      {
         // delete user from session
         foreach ($_SESSION['users'] as $key => $user)
         {
            if ($user['id'] == $this->getEntity()->id)
            {
               unset($_SESSION['users'][$key]);
               break;
            }
         }
      }

      public function update() : void
      {
         // update user from session
         foreach ($_SESSION['users'] as $key => $user)
         {
            if ($user['id'] == $this->getEntity()->id)
            {
               $_SESSION['users'][$key] = $this->getEntity();
               break;
            }
         }
      }    
   }

   // header('location:' .  $_POST['location']);



   