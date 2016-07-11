<?php
// Includes
include_once('../../includes/header.inc');
include_once('../../models/user.php');

$id = $_GET['id'];
$UserClass = new User();
$user = $UserClass->singleUser($id);

?>

<pre>
  <?php print_r($user);
   ?>
</pre>

<?php include_once('../../' . dirname('.') . '/includes/footer.inc'); ?>
