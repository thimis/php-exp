<?php
  include_once('/home/ubuntu/workspace/includes/header.inc');
  include_once('/home/ubuntu/workspace/models/user.php');

  $User = new User();
  $user = $_POST;

  if ($User->login($user, $session)) {
    header("Location: http://localhost/?loggedIn", true, 302);
  } else {
    header("Location: http://localhost/?loginError", true, 302);
  }
?>
