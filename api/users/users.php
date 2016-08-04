<?php
// Includes
include_once('/app/includes/header.inc');
include_once('/app/models/user.php');

// Retrieve the entries
$UserClass = new User();
$users = $UserClass->allUsers();
?>

<pre>
  <?php
  print_r($users);
  ?>
</pre>

<?php include_once('/app/includes/footer.inc'); ?>
