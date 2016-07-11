  <?php

  // Includes
  include_once('../../models/user.php');

  // Create new Photo object
  $User = new User();

  // integrate the surrounding code into the photo class
  $User->createUser($_POST);
