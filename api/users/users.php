<?php
// Includes
include_once('../../includes/header.inc');
include_once('../../models/user.php');

// Retrieve the entries
$UserClass = new User();
$users = $UserClass->allUsers();
?>

<pre>
  <?php
  print_r($users);
  ?>
</pre>

<?php include_once('../../' . dirname('.') . '/includes/footer.inc'); ?>
