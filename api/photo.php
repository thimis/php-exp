<?php
// Includes
include_once('../' . dirname('.') . '/includes/header.inc');
include_once('../' . dirname('.') . '/lib/db.php');
include_once('../' . dirname('.') . '/models/photo.php');

$id = $_GET['id'];
$PhotoClass = new Photo();
$photo = $PhotoClass->singlePhoto($id);

?>

<div class="container">

  <div class="row">
    <div class="col-md-6">
      <img src="/images/<?php echo $photo['image']; ?>" />
      <h1><?php echo $photo['title']; ?></h1>
      <p>
        <?php echo $photo['description']; ?>
      </p>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">

      <div class="btn-group" role="group">
        <a class="btn btn-default btn-primary" href="/photos">All photos</a>
        <a class="btn btn-default btn-danger" href="/photo/<?php echo $photo['id']; ?>/delete">Delete</a>
        <a class="btn btn-default btn-info" href="/photo/<?php echo $photo['id']; ?>/edit">Edit</a>
      </div>

    </div>
  </div>
</div>

<?php include_once('../' . dirname('.') . '/includes/header.inc'); ?>
