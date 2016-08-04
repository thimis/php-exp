<?php
  include_once('/app/includes/header.inc');
?>

<div class="container">

    <form enctype="multipart/form-data" action="/user/create" method="POST">

      <!-- Email field -->
        <label for="email">Email:</label>
        <input type="email" id="email" placeholder="Email address" name="email" >

      <!-- First Name / Last Name -->
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" placeholder="First Name" name="first_name">

        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" placeholder="Last Name" name="last_name">

      <!-- Password / Confirm Password -->
      <label for="password">Password:</label>
      <input type="password" id="password" name="password">

      <label for="confirm_password">Confirm Password:</label>
      <input type="password" id="confirm_password" name="confirm_password">

      <!-- Submit Button -->
      <button type="submit" class="button button-outline">Create User</button>

    </form>

</div>

<?php include_once('/app/includes/footer.inc'); ?>
