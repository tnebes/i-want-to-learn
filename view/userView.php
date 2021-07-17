<?php declare(strict_types=1);

   require_once '../functions.php';

   if (!isset($_SESSION['users']))
   {
      printError("No users found.");
   }
   // retrieve users from session
   $users = $_SESSION['users'];
   if (count($users) == 0)
   {
      printError("No users found.");
   }

   echo '<table class="table table-striped">';   
   echo '<tr><th>ID</th><th>Username</th><th>Email</th><th>Registration Date</th><th>Role</th></tr>';
   foreach ($users as $user)
   {
      echo '<tr>';
      echo '<td>' . $user->id . '</td>';
      echo '<td>' . $user->username . '</td>';
      echo '<td>' . $user->email . '</td>';
      echo '<td>' . $user->registration_date . '</td>';
      echo '<td>' . $user->role . '</td>';
      echo '</tr>';
   }
   echo '</table>';
?>