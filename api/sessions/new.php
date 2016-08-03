<?php
  include_once('/app/includes/header.inc');
  include_once('/app/models/user.php');

  $User = new User();
  $user = $_POST;

  if ($User->login($user, $session)) {
    header("Location: http://localhost/?loggedIn", true, 302);
  } else {
    header("Location: http://localhost/?loginError", true, 302);
  }
?>
