<?php
// Includes
include_once('/home/ubuntu/workspace/includes/header.inc');
include_once('/home/ubuntu/workspace/lib/db.php');
include_once('/home/ubuntu/workspace/models/photo.php');
include_once('/home/ubuntu/workspace/models/user.php');

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

<div class="container">

  <p id="test">
    click me
  </p>
</div>

<?php include_once('/home/ubuntu/workspace/includes/footer.inc'); ?>
