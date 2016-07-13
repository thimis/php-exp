  <?php

  // Includes
  include_once('../../models/user.php');
  include_once('../../includes/header.inc');
  // Create new Photo object
  $User = new User();

  // integrate the surrounding code into the photo class
  $_SESSION['user'] = array(
    'email' => 'email2',
    'first_name' => 'first name',
    'last_name' => 'last name',
  );
  $User->createUser($_POST);
