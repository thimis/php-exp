  <?php

  // Includes
  include_once('/home/ubuntu/workspace/lib/db.php');
  include_once('/home/ubuntu/workspace/models/photo.php');

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
    "filter" => $body["filter"],
    "user_id" => $body["user_id"],
  );

  // integrate the surrounding code into the photo class
   $Photo->savePhoto($photoArray);
