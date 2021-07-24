<?php declare(strict_types = 1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <?php require_once APPROOT . '/views/includes/head.php'; ?>
</head>
<body>
   <?php require_once APPROOT . '/views/includes/navigator.php'; ?>
   <div class="container">
   <?php if ($data['admin']): ?>
      <!-- TODO: implement searching users from here. -->
      <a href="<?php echo URLROOT ?>/users/register" class="success button">Add new user</a>
      <table class="table" id="admin-user-table">
         <thead>
            <tr>
               <th>ID</th>
               <th>Username</th>
               <th>Email</th>
               <th class="view-hidden">Registration date</th>
               <th>Role</th>
               <th class="view-hidden">Last login</th>
               <th>Banned</th>
               <th class="view-hidden">Date banned</th>
               <th>Actions</th>
            </tr>
         </thead>
         <tbody>
            <?php foreach ($data['users'] as $user): ?>
            <tr>
               <td><?php echo $user->id; ?></td>
               <td><?php echo '<a href=' . URLROOT . '/users/profile/' . $user->id . '>' . $user->username . '</a>'; ?></td>
               <td><?php echo $user->email; ?></td>
               <td class="view-hidden"><?php echo $user->registrationDate; ?></td>
               <td><?php echo $user->role; ?></td>
               <td class="view-hidden"><?php echo $user->lastLogin; ?></td>
               <td><?php echo $user->banned; ?></td>
               <td class="view-hidden"><?php echo $user->dateBanned; ?></td>
               <td class="actions"><div><?php echo getActionsOnUser((int) $user->id); ?></div></td>
            </tr>
            <?php endforeach; ?>
         </tbody>
      </table>
   <?php else: ?>
      <table class="table">
         <thead>
            <tr>
               <th>Username</th>
               <th>Registration date</th>
            </tr>
         </thead>
         <tbody>
            <?php foreach ($data['users'] as $user): ?>
            <tr>
               <td><?php echo $user->username; ?></td>
               <td><?php echo $user->registrationDate; ?></td>
            </tr>
            <?php endforeach; ?>
         </tbody>
      </table>
   <?php endif; ?>
   </div>
   <?php require_once APPROOT . '/views/includes/footer.php'; ?>
   <?php require_once APPROOT . '/views/includes/javascript.php'; ?>
</body>


</html>