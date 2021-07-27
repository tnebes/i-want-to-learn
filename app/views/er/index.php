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
      <div class="callout large primary">
         <a href="<?php echo URLROOT?>/er/image"><h1>View the diagram here.</h1></a>
      <pre>
         <?php
            $filepath = APPROOT . DIRECTORY_SEPARATOR . 'erdiagram' . DIRECTORY_SEPARATOR . 'i_want_to_learn.sql';
            $file = fopen($filepath, 'r');
            if ($file)
            {
               //echo the file line by line
               while(!feof($file))
               {
                  $content = filter_var(fgets($file), FILTER_SANITIZE_STRING);
                  echo '<code>';
                  echo htmlspecialchars($content);
                  echo '</code>';
               }
               fclose($file);
            }
         ?>
      </pre>

      </div>
   </div>

   <?php require_once APPROOT . '/views/includes/footer.php'; ?>
   <?php require_once APPROOT . '/views/includes/javascript.php'; ?>
</body>


</html>