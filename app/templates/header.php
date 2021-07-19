<div class="title-bar" data-responsive-toggle="example-menu" data-hide-for="medium">
  <button class="menu-icon" type="button" data-toggle></button>
  <div class="title-bar-title">Menu</div>
</div>

<div class="top-bar" id="example-menu">
  <div class="top-bar-left">
    <ul class="dropdown menu" data-dropdown-menu>
      <li class="menu-text"><a href="<?php echo $APPLICATION_PATH?>index.php">IWTL</a></li>
      <li class="has-submenu">
        <a href="#0">Content</a>
        <ul class="submenu menu vertical" data-submenu>
          <li><a href="<?php echo $APPLICATION_PATH ?>topic.php">Topics</a></li>
          <li><a href="#0">Suggestions</a></li>
          <li><a href="#0">Users</a></li>
        </ul>
      </li>
      <? if(!isAuthorised()): ?>
      <li><a href="<?php echo $APPLICATION_PATH ?>config/login.php">Login</a></li>
      <? else:?>
      <li><a href="#0">Options</a></li>
      <!-- add a link to the user's profile -->
      <li><a href="<?php echo $APPLICATION_PATH ?>view/myProfile.php">My Profile</a></li>
      <li><a href="<?php echo $APPLICATION_PATH ?>view/adminPanel/adminPanel.php">Control panel</a></li>
      <li><a href="<?php echo $APPLICATION_PATH ?>config/logout.php">Logout</a></li>
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