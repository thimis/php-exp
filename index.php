<?php
  include_once(dirname('.') . '/includes/header.inc');
  if (!empty($_GET["message"])) {
    $message = $_GET["message"];

    if ($message == 'saved') {
      $alert = '<div class="alert alert-success" role="alert">Image successfully saved!</div>';
    } elseif($message == 'notsaved') {
      $alert = '<div class="alert alert-danger" role="alert">There was a problem saving the image. Try again later</div>';
    } elseif($message == 'emptyfield') {
      $alert = '<div class="alert alert-warning" role="alert">One or more fields are empty.</div>';
    } else {
      $alert = '';
    }
  }
?>

<?php echo $alert; ?>
<div class="container">
<div class="row">
  <div class="col-md-4">
    <form enctype="multipart/form-data" action="api/index.php" method="post">
      <form action='' method='POST' enctype='multipart/form-data'>
        <input type='file' name='userFile'><br>
        <input type='submit' name='upload_btn' value='upload'>
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
<br><br>
<?php
// Retrieve the entries
$mysql = new mysqli($ip, "root", NULL, "photoApp");
$photos = $mysql->query("SELECT * FROM photos");
?>

  <div class="row">
  <?php while($row=$photos->fetch_array()) { ?>
    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
      <div class="thumbnail">
        <img src="<?php echo '/images/' . $row['image']; ?>">
        <div class="caption">
          <h3><?php echo $row['title']; ?></h3>
          <p><?php echo $row['description']; ?></p>
        </div>
      </div>
    </div>
  <?php } ?>
  </div>
</div>

<?php include_once(dirname('.') . '/includes/header.inc'); ?>
