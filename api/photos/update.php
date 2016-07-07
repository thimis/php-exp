<?php
// Includes
include_once('../../' . dirname('.') . '/lib/db.php');
include_once('../../' . dirname('.') . '/models/photo.php');

$photo = $_POST;
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
