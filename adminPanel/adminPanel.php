<?php declare(strict_types = 1);
   require_once '../config.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <?php require_once '../templates/head.php'?>
</head>
<body>
   <?php require_once '../templates/header.php'?>

   <ul class="tabs" data-tabs id="example-tabs">
   <li class="tabs-title is-active"><a href="#panel1" aria-selected="true">Users</a></li>
   <li class="tabs-title"><a href="#panel2">Topics</a></li>
   <li class="tabs-title"><a href="#panel3">Suggestions</a></li>
   <li class="tabs-title"><a href="#panel4">Images</a></li>
   <li class="tabs-title"><a href="#panel5">Reviews</a></li>
   </ul>

   <div class="tabs-content" data-tabs-content="example-tabs">
   <div class="tabs-panel is-active" id="panel1">
      <p>Users</p>
      <p>Use this tab to create, modify, ban or delete users.</p>
      <?php require_once '../view/userView.php' ?>

   </div>
   <div class="tabs-panel" id="panel2">
      <p>Topics</p>
      <img class="thumbnail" src="assets/img/generic/rectangle-7.jpg" alt="">
   </div>
   <div class="tabs-panel" id="panel3">
      <p>Suggestions</p>
      <p>Check me out! I'm a super cool Tab panel with text content!</p>
   </div>
   <div class="tabs-panel" id="panel4">
      <p>Images</p>
      <img class="thumbnail" src="assets/img/generic/rectangle-2.jpg" alt="">
   </div>
   <div class="tabs-panel" id="panel5">
      <p>Reviews</p>
      <p>Check me out! I'm a super cool Tab panel with text content!</p>
   </div>

   <?php require_once '../templates/footer.php'?>
   <?php require_once '../templates/javascript.php'; ?>
</body>
</html>
