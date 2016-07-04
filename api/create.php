  <?php

  // Includes
  include_once('../' . dirname('.') . '/lib/db.php');
  include_once('../' . dirname('.') . '/models/photo.php');

  // POST params + Image file
  $body = $_POST;
  $info = $_FILES["userFile"];
  $fileName = $info["name"];
  $fileTmpName = $info["tmp_name"];

  // Create new Photo object
  $Photo = new Photo();
  $photoArray = array(
    "title" => $body["title"],
    "description" => $body["description"],
    "image" => $fileName,
    "temp" => $fileTmpName,
  );

  // integrate the surrounding code into the photo class
  $Photo->savePhoto($photoArray);
