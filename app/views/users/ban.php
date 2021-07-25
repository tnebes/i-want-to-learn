<?php declare(strict_types = 1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <?php require_once APPROOT . '/views/includes/head.php'; ?>
</head>
<body>
   <?php require_once APPROOT . '/views/includes/navigator.php'; ?>
   <div class="callout large alert">
      <h1><?php echo $data->banned != 0 ? 'Unban' : 'Ban' ?> <?php echo $data->username ?></h1>
      <p>
         Are you sure you wish to <?php echo $data->banned != 0 ? 'unban' : 'ban' ?> <?php echo $data->username ?>?<br /> This action can be undone.
      </p>
      <div>
         <!-- no need to use php tags -->
         <a class="button alert" href="<?php echo URLROOT . '/users/ban/' . $data->id . '/true'?>">Yes</a>
         <a class="button success" href="<?php echo URLROOT . '/users/ban/' . $data->id . '/false'?>">No</a>
      </div>
   </div>
   <?php require_once APPROOT . '/views/includes/footer.php'; ?>
   <?php require_once APPROOT . '/views/includes/javascript.php'; ?>
</body>


</html>