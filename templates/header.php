<div class="title-bar" data-responsive-toggle="example-menu" data-hide-for="medium">
  <button class="menu-icon" type="button" data-toggle></button>
  <div class="title-bar-title">Menu</div>
</div>

<div class="top-bar" id="example-menu">
  <div class="top-bar-left">
    <ul class="dropdown menu" data-dropdown-menu>
      <li class="menu-text">IWTL</li>
      <li class="has-submenu">
        <a href="#0">Content</a>
        <ul class="submenu menu vertical" data-submenu>
          <li><a href="#0">Topics</a></li>
          <li><a href="#0">Suggestions</a></li>
          <li><a href="#0">Users</a></li>
        </ul>
      </li>
      <?php if(!isAuthorised()): ?>
      <li><a href="<?php echo $APPLICATION_PATH ?>login.php">Login</a></li>
      <?php else:?>
      <li><a href="#0">Options</a></li>
      <li><a href="#0">Control panel</a></li>
      <li><a href="<?php echo $APPLICATION_PATH ?>logout.php">Logout</a></li>
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