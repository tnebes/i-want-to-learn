<?php declare(strict_types = 1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <?php require_once APPROOT . '/views/includes/head.php'; ?>
</head>
<body>
   <?php require_once APPROOT . '/views/includes/navigator.php'; ?>
   <h1><?php echo $data['user']->username?>'s Profile</h1>
   <div>
      <a href="<?php echo URLROOT . '/users/profile/' . $data['user']->id ?>" class="button">View user</a>
      <a href="<?php echo URLROOT . '/users/delete/' . $data['user']->id ?>" class="warning button">Delete user</a>
      <a href="<?php echo URLROOT . '/users/ban/' . $data['user']->id ?>" class="alert button">Ban user</a>
   </div>
   <form method="post" action="<?php echo URLROOT . '/users/update/' . $data['user']->id ?>">
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
               <td><?php echo $data['user']->username ?></td>
               <td><span class="invalidFeedback"><?php echo $data['usernameError']?></span><input type="text" name="username" value="<?php echo $data['user']->username ?>"></td>
            </tr>
            <tr>
               <td>Email</td>
               <td><?php echo $data['user']->email ?></td>
               <td><span class="invalidFeedback"><?php echo $data['emailError']?><input type="email" name="email" value="<?php echo $data['user']->email ?>"></td>
            </tr>
            <tr>
               <td>Registration date</td>
               <td><?php echo date('Y-m-d', strtotime($data['user']->registrationDate)) ?></td>
               <!-- change type to date and make the php fill it out with proper values -->
               <td><span class="invalidFeedback"><?php echo $data['registrationDateError']?><input type="date" name="registrationDate" value="<?php echo date('Y-m-d', strtotime($data['user']->registrationDate)) ?>"></td>
            </tr>
            <tr>
               <td>Role</td>
               <td><?php echo $data['user']->role ?></td>
               <td><span class="invalidFeedback"><?php echo $data['roleError']?><input type="text" name="role" value="<?php echo $data['user']->role ?>"></td>
            </tr>
            <tr>
               <td>Last login</td>
               <td><?php echo date('Y-m-d', strtotime($data['user']->lastLogin)) ?></td>
               <!-- change type to date and make the php fill it out with proper values -->
               <td><span class="invalidFeedback"><?php echo $data['lastLoginError']?><input type="date" name="lastLogin" value="<?php echo date('Y-m-d', strtotime($data['user']->lastLogin)) ?>"></td>
            </tr>
            <tr>
               <td>Banned</td>
               <td><?php echo $data['user']->banned ?></td>
               <td><span class="invalidFeedback"><?php echo $data['bannedError']?><input type="checkbox" name="banned" value="1" <?php if ($data['user']->banned) echo 'checked'; ?>></td>
            </tr>
            <tr>
               <td>Date banned</td>
               <td><?php echo date('Y-m-d', strtotime($data['user']->dateBanned))?></td>
               <td><span class="invalidFeedback"><?php echo $data['dateBannedError']?><input type="date" name="dateBanned" value="<?php echo date('Y-m-d', strtotime($data['user']->dateBanned)) ?>"></td>
            </tr>
         </tbody>
      </table>
      <input type="submit" name="update" value="Update" class="success button">
   </form>
   <?php require_once APPROOT . '/views/includes/footer.php'; ?>
   <?php require_once APPROOT . '/views/includes/javascript.php'; ?>
</body>


</html>