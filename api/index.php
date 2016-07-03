<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
</head>
<body>

<?php
$body = $_POST;
$info = $_FILES;
$fileName = $info["name"];
$fileTmpName = $info["tmp_name"];
$target = "\/images/".$fileName;

move_uploaded_file( $fileTmpName, $target);

?>

  <h1>Message: <?php echo $_POST["message"]; ?></h1>
  <img src="/images/<?php echo $fileName; ?>" alt="" />
  <h2><?php echo $body["title"]; ?></h2>
  <p>
    <?php echo $body["description"]; ?>
  </p>

  <pre>
    <?php print_r($body); ?>
  </pre>

  <pre>
    <?php print_r($fileName); ?>
  </pre>

  <h1>hello?</h1>
</body>
</html>
