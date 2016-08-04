<?php
// Includes
include_once('../../lib/db.php');
include_once('../../models/user.php');
include_once('../../includes/header.inc');


$id = $_GET['id'];

if (!($session->get('user.id') == $id)) {
  header("Location: http://localhost/photos?message=notAllowed", true, 302);
}

$UserClass = new User();
$deleteMessage = $UserClass->deleteUser($id);
header("Location: http://localhost/photos?message=" . $deleteMessage, true, 302);
