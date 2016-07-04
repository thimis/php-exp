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
        <a class="btn btn-default btn-primary" href="/api/photos.php">All photos</a>
        <a class="btn btn-default btn-danger" href="/api/delete.php?id=<?php echo $photo['id']; ?>">Delete</a>
        <a class="btn btn-default btn-info" href="/api/edit.php?id=<?php echo $photo['id']; ?>">Edit</a>
      </div>

    </div>
  </div>
</div>

<?php include_once('../' . dirname('.') . '/includes/header.inc'); ?>
