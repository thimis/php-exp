<?php

include_once('/home/ubuntu/workspace/models/session.php');

if (!isset($session)) {
  $session = new SecureSessionHandler('user');
}

ini_set('session.save_handler', 'files');
session_set_save_handler($session, true);
session_save_path('/tmp');

$session->start();

if (!$session->isValid()) {
  $session->forget();
}
