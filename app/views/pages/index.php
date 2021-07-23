<?php declare(strict_types = 1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <?php require_once APPROOT . '/views/includes/head.php'; ?>
</head>
<body>
   <?php require_once APPROOT . '/views/includes/navigator.php'; ?>
   <!-- foundation index page -->
   <div class="section-landing">
      <div class="wrapper-landing">
         <h1>Learn everything.</h1>
         <h2>Are you an in-depth learner?</h2>
         <div class="landing-text" style="display: none">
            <h3>Are you looking for a specific subject?</h3>
            <h4>Are you looking for a specific course?</h4>
            <h5>Are you looking for a specific book?</h5>
            <h6>Are you looking for specific materials?</h6>
         </div>
         <h3>IWTL is a community-driven project</h2>
         <h3>Read, learn and contribute.</h3>
         <a class="large button" href="<?php echo URLROOT?>/users/register">Join now.</a>
      </div>
   </div>
   <?php require_once APPROOT . '/views/includes/footer.php'; ?>
   <?php require_once APPROOT . '/views/includes/javascript.php'; ?>
</body>


</html>