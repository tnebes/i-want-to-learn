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
         <form method="POST">
            <button type="submit" name="confirm" value="true" class="button alert">Yes</button>
            <button type="submit" name="confirm" value="false" class="button success">No</button>
         </form>
      </div>
   </div>
   <?php require_once APPROOT . '/views/includes/footer.php'; ?>
   <?php require_once APPROOT . '/views/includes/javascript.php'; ?>
</body>


</html>