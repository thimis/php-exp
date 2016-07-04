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
    <div class="column">
      <form enctype="multipart/form-data" action="/api/update.php" method="POST">

        <!-- Hidden id field -->
        <input type="hidden" name="id" value="<?php echo $photo['id']; ?>">

        <!-- Hidden image field -->
        <input type="hidden" name="image" value="<?php echo $photo['image']; ?>">

        <!-- Image -->
        <img src="/images/<?php echo $photo['image']; ?>" /><br><br>

        <!-- Title/Description fields -->
          <label for="title">Title:</label>
          <input type="text" class="form-control" id="title" placeholder="Message" name="title" value="<?php echo $photo['title']; ?>">

          <label class="f2 mb2 db" for="description">Description:</label>
          <textarea class="db w-100" type="text" class="form-control" id="message" placeholder="Description" name="description" rows="6"><?php echo $photo['description']; ?></textarea>

        <!-- Submit Button -->
        <button type="submit" class="button button-outline">Submit</button>
      </form>
    </div>
  </div>
</div>
<?php include_once(dirname('.') . '/includes/header.inc'); ?>
