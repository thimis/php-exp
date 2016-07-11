<?php
$alert = '';
if (!empty($_GET["message"])) {
  $message = $_GET["message"];

  if ($message == 'saved') {
    $alert = '<div class="alert alert-success" role="alert">Image successfully saved!</div>';
  } elseif($message == 'notsaved') {
    $alert = '<div class="alert alert-danger" role="alert">There was a problem saving the image. Try again later</div>';
  } elseif($message == 'emptyfield') {
    $alert = '<div class="alert alert-warning" role="alert">One or more fields are empty.</div>';
  } elseif($message == 'deleteSuccess') {
    $alert = '<div class="alert alert-success" role="alert">Photo successfully removed.</div>';
  } elseif($message == 'deleteFail') {
    $alert = '<div class="alert alert-danger" role="alert">Unable to delete photo.</div>';
  } elseif($message == 'editSuccess') {
    $alert = '<div class="alert alert-success" role="alert">Photo edited successfully</div>';
  } elseif($message == 'deleteFail') {
    $alert = '<div class="alert alert-danger" role="alert">Unable to edit photo.</div>';
  } elseif($message == 'notImage') {
    $alert = '<div class="alert alert-warning" role="alert">Please upload images only.</div>';
  } elseif($message == 'passwordMismatch') {
    $alert = '<div class="alert alert-danger" role="alert">Passwords do not match.</div>';
  } elseif($message == 'emailTaken') {
    $alert = '<div class="alert alert-warning" role="alert">That email address is already in use.</div>';
  }
}
?>

<?php echo $alert; ?>
