<?php
// Includes
include_once('/home/ubuntu/workspace/models/photo.php');
include_once('/home/ubuntu/workspace/includes/header.inc');

$id = $_GET['id'];
$PhotoClass = new Photo();

$photo = $PhotoClass->singlePhoto($id);

if (!($session->get('user.id') == $photo['user_id'])) {
  header("Location: /photos?message=notAllowed", true, 302);

} else {
  $deleteMessage = $PhotoClass->deletePhoto($id);
  header("Location: /photos?message=" . $deleteMessage, true, 302);
}
