  <?php

  // Includes
  include_once('/app/models/user.php');
  include_once('/app/includes/header.inc');
  // Create new Photo object
  $User = new User();

  // integrate the surrounding code into the photo class
  $User->createUser($_POST, $session);
