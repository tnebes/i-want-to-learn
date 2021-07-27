<?php declare(strict_types = 1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <?php require_once APPROOT . '/views/includes/head.php'; ?>
</head>
<body>
   <?php require_once APPROOT . '/views/includes/navigator.php'; ?>

   <!-- page displays user information -->
   <div class="container">
      <div class="row">
         <div class="col-md-9">
            <div>
            <h1><?php echo $data->username ?>'s Profile </h1>
               <?php if (isAdmin())
               {
                  echo '<a class="button" href=' . URLROOT . '/users/update/' . $data->id . '>Edit User</a>';
                  echo '<a class="button warning" href=' . URLROOT . '/users/delete/' . $data->id . '>Delete User</a>';
                  echo '<a class="button alert" href=' . URLROOT . '/users/ban/' . $data->id . '>Ban User</a>';
               }
               ?>
            </div>
            <table class="table table-striped">
               <thead>
                  <tr>
                     <th>Field</th>
                     <th>Value</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td>Username</td>
                     <td><?php echo $data->username ?></td>
                  </tr>
                  <?php if(isAdmin()): ?>
                  <tr>
                     <td>Email</td>
                     <td><?php echo $data->email; ?></td>
                  </tr>
                  <?php endif; ?>
                  <tr>
                     <td>Registration Date</td>
                     <td><?php echo $data->registrationDate ?></td>
                  </tr>
                  <?php if(isAdmin()): ?>
                  <tr>
                     <td>Role</td>
                     <td><?php echo $data->role ?></td>
                  </tr>
                  <tr>
                     <td>Last Login</td>
                     <td><?php echo $data->lastLogin ?></td>
                  </tr>
                  <tr>
                     <td>Banned</td>
                     <td><?php echo $data->banned ?></td>
                  </tr>
                  <tr>
                     <td>Date Banned</td>
                     <td><?php echo $data->dateBanned ?></td>
                  </tr>
                  <?php endif; ?>
               </tbody>
            </table>
         </div>
      </div>
   </div>


   <?php require_once APPROOT . '/views/includes/footer.php'; ?>
   <?php require_once APPROOT . '/views/includes/javascript.php'; ?>
</body>


</html>