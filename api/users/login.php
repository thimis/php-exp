<?php
  include_once('../../includes/header.inc');

  if ($session->get('user.loggedin')) {
    header("Location: http://localhost/photos/", true, 302);
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
