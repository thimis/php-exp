<?php
// Includes
include_once('/app/includes/header.inc');
include_once('/app/lib/db.php');
include_once('/app/models/photo.php');
include_once('/app/models/user.php');

$id = $_GET['id'];
$PhotoClass = new Photo();

$photo = $PhotoClass->singlePhoto($id);

?>


<div class="container photo--container">

  <div class="row">
    <div class="column">
      <figure id="image" class="<?php echo $photo['filter']; ?>">
        <img src="/images/<?php echo $photo['image']; ?>" />
      </figure>
      <h1 class="photo--title"><?php echo $photo['title']; ?></h1>
      <span class="photo--author"><?php echo $photo['user']['name'] . ' - ' . $photo['user']['email']; ?></span>
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

<?php include_once('/app/includes/footer.inc'); ?>
