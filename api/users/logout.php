<?php
  include_once('/app/includes/header.inc');

  $session->put('user', null);
  $session->forget();
  header("Location: http://localhost/", true, 302);
?>
