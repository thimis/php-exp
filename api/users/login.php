<?php
  include_once('/home/ubuntu/workspace/includes/header.inc');

  if ($session->get('user.loggedin')) {
    header("Location: /photos/", true, 302);
  }
?>

<div class="container">

    <form enctype="multipart/form-data" action="/session/new" method="POST">

    <!-- Email field -->
      <label for="email">Email:</label>
      <input type="email" id="email" placeholder="Email address" name="email" >

      <!-- Password / Confirm Password -->
      <label for="password">Password:</label>
      <input type="password" id="password" name="password">

      <!-- Submit Button -->
      <button type="submit" class="button button-outline">Login</button>

    </form>

</div>

<?php include_once('/home/ubuntu/workspace/includes/footer.inc'); ?>
