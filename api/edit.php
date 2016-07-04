<?php
  include_once('../' . dirname('.') . '/includes/header.inc');
  include_once('../' . dirname('.') . '/lib/db.php');
  include_once('../' . dirname('.') . '/models/photo.php');

  $id = $_GET['id'];
  $PhotoClass = new Photo();
  $photo = $PhotoClass->singlePhoto($id);
?>



<div class="container">
  <div class="row">
    <div class="col-md-4">
      <form enctype="multipart/form-data" action="/api/update.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $photo['id']; ?>">
        <input type="hidden" name="image" value="<?php echo $photo['image']; ?>">
        <img src="/images/<?php echo $photo['image']; ?>" /><br><br>
        <div class="form-group">
          <label for="title">Title:</label>
          <input type="text" class="form-control" id="title" placeholder="Message" name="title" value="<?php echo $photo['title']; ?>">
        </div>
        <div class="form-group">
          <label for="description">Description:</label>
          <textarea type="text" class="form-control" id="message" placeholder="Description" name="description"><?php echo $photo['description']; ?></textarea>
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">

      <div class="btn-group" role="group">
        <a class="btn btn-default btn-primary" href="/api/photos.php">All photos</a>
      </div>

    </div>
  </div>

</div>
<?php include_once(dirname('.') . '/includes/header.inc'); ?>
