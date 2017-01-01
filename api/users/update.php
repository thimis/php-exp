<?php
// Includes
include_once('/home/ubuntu/workspace/lib/db.php');
include_once('/home/ubuntu/workspace/models/photo.php');
include_once('/home/ubuntu/workspace/includes/header.inc');

$photo = $_POST;

if (!($session->get('user.id') == $photo['id'])) {
  header("Location: /photos?message=notAllowed", true, 302);
}

$photoArray = array(
  "id" => $photo['id'],
  "title" => $photo['title'],
  "description" => $photo['description'],
  "filter" => $photo['filter'],
);
$PhotoClass = new Photo();
$updateMessage = $PhotoClass->updatePhoto($photoArray);
header("Location: /photos?message=" . $updateMessage, true, 302);

?>
