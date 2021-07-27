<?php declare(strict_types = 1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <?php require_once APPROOT . '/views/includes/head.php'; ?>
</head>
<body>
   <?php require_once APPROOT . '/views/includes/navigator.php'; ?>
   <h1><?php echo $data->username?>'s profile</h1>
   <div>
      <a href="<?php echo URLROOT . '/users/profile/' . $data->id ?>" class="button">View user</a>
      <a href="<?php echo URLROOT . '/users/delete/' . $data->id ?>" class="alert button">Delete user</a>
      <a href="<?php echo URLROOT . '/users/ban/' . $data->id ?>" class="warning button">Ban user</a>
   </div>

   <form method="post" action="<?php echo URLROOT . '/users/update/' . $data->id ?>">
      <table class="table">
         <thead>
            <tr>
               <th>Name</th>
               <th>Value</th>
               <th>New Value</th>
            </tr>
         </thead>
         <tbody>
            <tr>
               <td>Username</td>
               <td><?php echo $data->username ?></td>
               <td><input type="text" name="username" value="<?php echo $data->username ?>"></td>
            </tr>
            <tr>
               <td>Email</td>
               <td><?php echo $data->email ?></td>
               <td><input type="email" name="email" value="<?php echo $data->email ?>"></td>
            </tr>
            <tr>
               <td>Registration date</td>
               <td><?php echo date('Y/m/d', strtotime($data->registrationDate)) ?></td>
               <!-- change type to date and make the php fill it out with proper values -->
               <td><input type="date" name="registrationDate" value="<?php echo date('Y/m/d', strtotime($data->registrationDate)) ?>"></td>
            </tr>
            <tr>
               <td>Role</td>
               <td><?php echo $data->role ?></td>
               <td><input type="text" name="role" value="<?php echo $data->role ?>"></td>
            </tr>
            <tr>
               <td>Last login</td>
               <td><?php echo date('Y/m/d', strtotime($data->lastLogin)) ?></td>
               <!-- change type to date and make the php fill it out with proper values -->
               <td><input type="date" name="lastLogin" value="<?php echo date('Y/m/d', strtotime($data->lastLogin)) ?>"></td>
            </tr>
            <tr>
               <td>Banned</td>
               <td><?php echo $data->banned ?></td>
               <td><input type="checkbox" name="banned" value="1" <?php if ($data->banned) echo 'checked'; ?>></td>
            </tr>
            <tr>
               <td>Date banned</td>
               <td><?php echo date('Y/m/d',strtotime($data->dateBanned))?></td>
               <td><input type="text" name="dateBanned" value="<?php echo date('Y/m/d',strtotime($data->dateBanned)) ?>"></td>
            </tr>
         </tbody>
      </table>
      <input type="submit" name="update" value="Update" class="success button">
   </form>
   <?php require_once APPROOT . '/views/includes/footer.php'; ?>
   <?php require_once APPROOT . '/views/includes/javascript.php'; ?>
</body>


</html>