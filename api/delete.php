<?php
// Includes
include_once('../' . dirname('.') . '/lib/db.php');
include_once('../' . dirname('.') . '/models/photo.php');

$id = $_GET['id'];
$PhotoClass = new Photo();
$deleteMessage = $PhotoClass->deletePhoto($id);
header("Location: http://localhost/api/photos.php?message=" . $deleteMessage, true, 302);
