<?php declare(strict_types=1);

   require_once '../functions.php';

   function createUserTable(array $users) : void
   {
      echo '<table class="table table-striped">';   
      echo '<tr><th>ID</th><th>Username</th><th>Email</th><th>Registration Date</th><th>Role</th></tr>';
      foreach ($users as $user)
      {
         echo '<tr>';
         echo '<td>' . $user->id . '</td>';
         echo '<td>' . $user->username . '</td>';
         echo '<td>' . $user->email . '</td>';
         echo '<td>' . $user->registrationDate . '</td>';
         echo '<td>' . $user->role . '</td>';
         echo '<td>' . $user->lastLogin . '</td>';
         echo '</tr>';
      }
      echo '</table>';   
   }

   function main() : void
   {
      if (isset($_SESSION['users']) && count($_SESSION['users']) > 0)
      {
         createUserTable($_SESSION['users']);
      }
      else
      {
         printError('No users found.');
      }
   }

   main();

?>