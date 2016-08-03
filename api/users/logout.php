<?php
  include_once('../../includes/header.inc');

  $session->put('user', null);
  $session->destroy();
  header("Location: http://localhost/", true, 302);
?>
