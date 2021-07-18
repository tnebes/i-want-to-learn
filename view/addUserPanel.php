<form class="add-user-form" action="../controller/userController.php" method="post">
   <div class="field">
      <label for="username">Username</label>
      <input type="text" name="username" id="username" class="input">
   </div>
   <div class="field">
      <label for="email">Email</label>
      <input type="email" name="email" id="email" class="input">
   </div>
   <div class="field">
      <label for="password">Password</label>
      <input type="password" name="password" id="password" class="input">
   </div>
   <button type="submit" class="button is-primary">Add User</button>
</form>