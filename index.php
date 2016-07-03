<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title></title>
</head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="/css/main.css" charset="utf-8">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<body>

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
</div>

<pre>
  <?php $_FILES['photo']; ?>
</pre>

</body>
</html>
