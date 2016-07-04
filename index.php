<?php
  include_once(dirname('.') . '/includes/header.inc');
  include_once(dirname('.') . '/lib/db.php');
  include_once(dirname('.') . '/models/photo.php');
?>

<div class="container">
  <div class="row">
    <div class="col-md-4">
      <form enctype="multipart/form-data" action="api/create.php" method="post">
          <input type='file' name='userFile'><br>
          <div class="form-group">
          <label for="title">Title:</label>
          <input type="text" class="form-control" id="title" placeholder="Message" name="title">
        </div>
        <div class="form-group">
          <label for="description">Description:</label>
          <textarea type="text" class="form-control" id="message" placeholder="Description" name="description"></textarea>
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">

      <div class="btn-group" role="group">
        <a class="btn btn-default" href="/api/photos.php">All photos</a>
      </div>

    </div>
  </div>

</div>
<?php include_once(dirname('.') . '/includes/header.inc'); ?>
