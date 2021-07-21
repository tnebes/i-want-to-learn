<div class="title-bar" data-responsive-toggle="example-menu" data-hide-for="medium">
  <button class="menu-icon" type="button" data-toggle></button>
  <div class="title-bar-title">Menu</div>
</div>

<?php var_dump($_SESSION); ?>

<div class="top-bar" id="example-menu">
  <div class="top-bar-left">
    <ul class="dropdown menu" data-dropdown-menu>
      <li class="menu-text">IWTL</li>
      <li class="has-submenu">
        <a href="#0">Content</a>
        <ul class="submenu menu vertical" data-submenu>
          <li><a href="<?php echo URLROOT ?>/topics">Topics</a></li>
          <li><a href="<?php echo URLROOT ?>/suggestions">Suggestions</a></li>
          <li><a href="<?php echo URLROOT ?>/users">Users</a></li>
        </ul>
      </li>
      <? if(!isLoggedIn()): ?> 
      <li><a href="<?php echo URLROOT ?>/users/login">Login</a></li>
      <li><a href="<?php echo URLROOT ?>/users/register">Register</a></li>
      <? else:?>
      <li><a href="#0">Options</a></li>
      <!-- add a link to the user's profile -->
      <li><a href="<?php echo URLROOT ?>/users">My Profile</a></li>
      <li><a href="<?php echo URLROOT ?>/adminPanel">Control panel</a></li>
      <li><a href="<?php echo URLROOT ?>/users/logout">Logout <span class="username"><?php echo $_SESSION['username'] ?></a></span></li>
      <? endif;?>
    </ul>
  </div>
  <div class="top-bar-right">
    <ul class="menu">
      <li><input type="search" placeholder="Search"></li>
      <li><button type="button" class="button">Search</button></li>
    </ul>
  </div>
</div>