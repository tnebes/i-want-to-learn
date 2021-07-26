<div class="title-bar" data-responsive-toggle="example-menu" data-hide-for="medium">
  <button class="menu-icon" type="button" data-toggle></button>
  <div class="title-bar-title">Menu</div>
</div>

<div class="top-bar" id="example-menu">
  <div class="top-bar-left">
    <ul class="dropdown menu" data-dropdown-menu>
      <a href="<?php echo URLROOT ?>"><img src=<?php echo URLROOT . '/public/images/logo2.png'?> class="logo" alt="logo"></a>
      <li class="has-submenu">
        <a href="#0">Content</a>
        <ul class="submenu menu vertical" data-submenu>
          <li><a href="<?php echo URLROOT ?>/topics">Topics</a></li>
          <li><a href="<?php echo URLROOT ?>/suggestions">Suggestions</a></li>
          <?php if(isLoggedIn()) echo '<li><a href="'. URLROOT . '/users">Users</a></li>' ?> 
        </ul>
      </li>
      <?php if(!isLoggedIn()): ?> 
      <li><a href="<?php echo URLROOT ?>/users/login">Login</a></li>
      <li><a href="<?php echo URLROOT ?>/users/register">Register</a></li>
      <?php else:?>
      <li><a href="<?php echo URLROOT ?>/options/">Options</a></li>
      <!-- add a link to the user's profile -->
      <li><a href="<?php echo URLROOT ?>/users">My Profile</a></li>
      <?php if(isAdmin()) echo '<li><a href="' . URLROOT . '/adminPanel">Control panel</a></li>' ?>
      <li><a href="<?php echo URLROOT ?>/users/logout">Logout <span class="username"><?php echo $_SESSION['username'] ?></a></span></li>
      <?php endif;?>
    </ul>
  </div>
  <div class="top-bar-right">
    <ul class="menu">
      <li><input type="search" placeholder="Search"></li>
      <li><button type="button" class="button">Search</button></li>
    </ul>
  </div>
</div>