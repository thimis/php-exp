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
  <div class="row">
  <?php for ($i = 0; $i < count($photos); $i++): ?>
    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
      <div class="thumbnail">
        <a href="/photo/<?php echo $photos[$i]['id']; ?>">
          <img src="<?php echo '/images/' . $photos[$i]['image']; ?>">
        </a>
        <div class="caption">
          <h3><?php echo $photos[$i]['title']; ?></h3>
          <p><?php echo $photos[$i]['description']; ?></p>
          <a class="btn btn-default btn-danger" href="/photo/<?php echo $photos[$i]['id']; ?>/delete">Delete</a>
          <a class="btn btn-default btn-info" href="/photo/<?php echo $photos[$i]['id']; ?>/edit">Edit</a>
        </div>
      </div>
    </div>
  <?php endfor; ?>
  </div>
</div>
</div>

<?php include_once('../' . dirname('.') . '/includes/header.inc'); ?>
