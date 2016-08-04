<?php
// Includes
include_once('/app/models/photo.php');

$user = $_GET['user_id'];
$photo = $_GET['photo_id'];

$PhotoClass = new Photo();

$res = $PhotoClass->like($user, $photo);

echo json_encode($res);
