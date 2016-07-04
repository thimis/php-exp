  <?php
  function save() {

    $body = $_POST;
    $title = $body["title"];
    $description = $body["description"];
    $info = $_FILES["userFile"];
    $fileName = $info["name"];
    $fileTmpName = $info["tmp_name"];
    $target = '/app/images/' . $fileName;

    // Save the file.
    if (move_uploaded_file($fileTmpName, $target)) {
      echo "\n";
    }

    // save the photo entry to the database
    $host= gethostname();
    $ip = gethostbyname($host);

    $mysql = new mysqli("localhost", "root", NULL, "photoApp");

    if ($mysql->query("INSERT INTO photos(id, image, title, description) VALUES('$title', '$fileName', '$title', '$description')")) {
      header("Location: http://localhost/index.php?message=saved", true, 302);
    } else {
      header("Location: http://localhost/index.php?message=notsaved", true, 302);
    }
  };

  if (!empty($title) &&
      !empty($description) &&
      !empty($fileName)
  ) {
    save();
  } else {
    header("Location: http://localhost/index.php?message=emptyfield", true, 302);
  }
