<?php declare(strict_types = 1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <?php require_once APPROOT . '/views/includes/head.php'; ?>
</head>
<body>
   <?php require_once APPROOT . '/views/includes/navigator.php'; ?>
   <div class="section-landing">
      <div class="wrapper-landing">
         <img src=<?php echo URLROOT . '/public/images/logo.png'?> alt="logo" href="<?php echo URLROOT ?>">
         <h1>Learn everything.</h1>
         <div class="row">
            <div class="small-6 columns">
            <h2>IWTL is a community-driven project for learning.</h2>
               <p> IWTL is a place where people can learn from each other, and where they can share their knowledge and experience.</p>
            </div>
            <div class="small-6 columns">
               <!-- example goes here. -->
            </div>
         </div>            
         <h2>Read, learn and contribute.</h2>
         <a class="large button" href="<?php echo URLROOT?>/users/register">Join now.</a>
      </div>
   </div>
   <div class="callout large primary text-center">
      <p>Code available at:</p>
      <a class="link" href="https://github.com/tnebes/i-want-to-learn"><img src="https://github.githubassets.com/images/modules/logos_page/GitHub-Logo.png" alt="GitHub" class="left" style="height: 10vw"></a>
   </div>

   <?php require_once APPROOT . '/views/includes/footer.php'; ?>
   <?php require_once APPROOT . '/views/includes/javascript.php'; ?>
</body>


</html>