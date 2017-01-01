  <?php

  // Includes
  include_once('/home/ubuntu/workspace/models/user.php');
  include_once('/home/ubuntu/workspace/includes/header.inc');
  // Create new Photo object
  $User = new User();

  // integrate the surrounding code into the photo class
  $User->createUser($_POST, $session);
