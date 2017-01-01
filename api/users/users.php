<?php
// Includes
include_once('/home/ubuntu/workspace/includes/header.inc');
include_once('/home/ubuntu/workspace/models/user.php');

// Retrieve the entries
$UserClass = new User();
$users = $UserClass->allUsers();
?>

<pre>
  <?php
  print_r($users);
  ?>
</pre>

<?php include_once('/home/ubuntu/workspace/includes/footer.inc'); ?>
