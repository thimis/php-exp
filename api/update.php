<?php
// Includes
include_once('../' . dirname('.') . '/lib/db.php');
include_once('../' . dirname('.') . '/models/photo.php');

$photo = $_POST;
$photoArray = array(
  "id" => $photo['id'],
  "title" => $photo['title'],
  "description" => $photo['description'],
);
$PhotoClass = new Photo();
$updateMessage = $PhotoClass->updatePhoto($photoArray);
// header("Location: http://localhost/api/photos.php?message=" . $updateMessage, true, 302);

?>
