<?php
// Includes
include_once('/app/includes/header.inc');
include_once('/app/models/user.php');

$id = $_GET['id'];
$UserClass = new User();
$user = $UserClass->singleUser($id);



?>

<pre>
  <?php print_r($user);
   ?>
</pre>

<?php include_once('/app/includes/footer.inc'); ?>
