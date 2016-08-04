<?php
// Includes
include_once('/app/models/photo.php');
include_once('/app/includes/header.inc');

$id = $_GET['id'];
$PhotoClass = new Photo();

$photo = $PhotoClass->singlePhoto($id);

if (!($session->get('user.id') == $photo['user_id'])) {
  header("Location: http://localhost/photos?message=notAllowed", true, 302);

} else {
  $deleteMessage = $PhotoClass->deletePhoto($id);
  header("Location: http://localhost/photos?message=" . $deleteMessage, true, 302);
}
