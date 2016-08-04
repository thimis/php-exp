<?php
// Includes
include_once('/app/lib/db.php');
include_once('/app/models/photo.php');
include_once('/app/includes/header.inc');

$photo = $_POST;

if (!($session->get('user.id') == $photo['id'])) {
  header("Location: http://localhost/photos?message=notAllowed", true, 302);
}

$photoArray = array(
  "id" => $photo['id'],
  "title" => $photo['title'],
  "description" => $photo['description'],
  "filter" => $photo['filter'],
);
$PhotoClass = new Photo();
$updateMessage = $PhotoClass->updatePhoto($photoArray);
header("Location: http://localhost/photos?message=" . $updateMessage, true, 302);

?>
