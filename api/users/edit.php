<?php
  include_once('/app/includes/header.inc');
  include_once('/app/models/user.php');

  $id = $_GET['id'];

  if (!($session->get('user.id') == $id)) {
    header("Location: http://localhost/photos?message=notAllowed", true, 302);
  }

  $UserClass = new User();
  $user = $UserClass->singleUser($id);
?>


<div class="container">
  <div class="row">
    <div class="column">

      <form enctype="multipart/form-data" action="/user/<?php $user[$id]; ?>/update" method="POST">

        <!-- Email field -->
        <label for="email">Email:</label>
        <input type="email" id="email" placeholder="Email address" name="email" value="<?php echo $user["email"]; ?>">

        <!-- First Name / Last Name -->
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" placeholder="First Name" name="first_name" value="<?php echo $user["first_name"]; ?>">

        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" placeholder="Last Name" name="last_name" value="<?php echo $user["last_name"]; ?>">

        <!-- Password / Confirm Password -->
        <label for="old_password">Old Password:</label>
        <input type="password" id="old_password" name="old_password">

        <label for="new_password">New Password:</label>
        <input type="password" id="new_password" name="new_password">

        <!-- Submit Button -->
        <button type="submit" class="button button-outline">Edit User</button>

      </form>

    </div>
  </div>
</div>





<?php include_once('/app/includes/footer.inc'); ?>
