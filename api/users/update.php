<?php
// Includes
include_once('../../lib/db.php');
include_once('../../models/photo.php');
include_once('../../includes/header.inc');

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
