<?php
  include_once('/home/ubuntu/workspace/includes/header.inc');

  $session->put('user', null);
  $session->forget();
  header("Location: /index.php", true, 302);
?>
