  <?php

  // Includes
  include_once('../../' . dirname('.') . '/models/user.php');

  // POST params
  $body = $_POST;

  // Create new Photo object
  $User = new User();
  $userArray = array(
    "email" => $body["email"],
    "first_name" => $body["first_name"],
    "last_name" => $body["last_name"],
    "password" => $body["password"],
    "confirm_password" => $body["confirm_password"],
  );

  // integrate the surrounding code into the photo class
  $User->createUser($userArray);
