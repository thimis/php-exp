<?php
// Includes
include_once('../' . dirname('.') . '/includes/header.inc');
include_once('../' . dirname('.') . '/lib/db.php');
include_once('../' . dirname('.') . '/models/photo.php');

// Retrieve the entries
$Photo = new Photo();
$photos = $Photo->allPhotos();
?>

<div class="container">
  <div class="flex row wrap halign-left">
  <?php for ($i = 0; $i < count($photos); $i++): ?>

    <div class="col-4 photo flex">
      <div class="photo--wrapper flex">
        <div class="center">
          <div class="flex column">
            <a href="/photo/<?php echo $photos[$i]['id']; ?>">
              <img src="<?php echo '/images/' . $photos[$i]['image']; ?>">
              <h3 class="photo--title tac"><?php echo $photos[$i]['title']; ?></h1>
            </a>
          </div>

          <div class="photo--options">
            <div class="flex column">

              <a class="button button-outline" href="/photo/<?php echo $photos[$i]['id']; ?>/edit">Edit</a>
              <a class="button button-clear button-black" href="/photo/<?php echo $photos[$i]['id']; ?>/delete">Delete</a>
            </div>
          </div>
        </div>
      </div>
    </div>

  <?php endfor; ?>
  </div>
</div>


<?php include_once('../' . dirname('.') . '/includes/header.inc'); ?>
