<?php
// Includes
include_once('../' . dirname('.') . '/includes/header.inc');
include_once('../' . dirname('.') . '/lib/db.php');
include_once('../' . dirname('.') . '/models/photo.php');

$id = $_GET['id'];
$PhotoClass = new Photo();
$photo = $PhotoClass->singlePhoto($id);

?>

<div class="container photo--container">

  <div class="row">
    <div class="column">
      <img src="/images/<?php echo $photo['image']; ?>" />
      <h1 class="photo--title"><?php echo $photo['title']; ?></h1>
      <p class="photo--description">
        <?php echo $photo['description']; ?>
      </p>
    </div>
  </div>

  <div class="row">
    <div class="column">
      <a class="button button-outline" href="/photo/<?php echo $photo['id']; ?>/edit">Edit</a>
      <a class="button button-clear button-black" href="/photo/<?php echo $photo['id']; ?>/delete">Delete</a>
    </div>
  </div>

</div>

<?php include_once('../' . dirname('.') . '/includes/header.inc'); ?>
