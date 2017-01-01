<?php
// Includes
include_once('/home/ubuntu/workspace/includes/header.inc');
include_once('/home/ubuntu/workspace/models/user.php');

$id = $_GET['id'];
$UserClass = new User();
$user = $UserClass->singleUser($id);



?>

<pre>
  <?php print_r($user);
   ?>
</pre>

<?php include_once('/home/ubuntu/workspace/includes/footer.inc'); ?>
