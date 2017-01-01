<?php
include_once('/home/ubuntu/workspace/includes/session.php');
error_reporting(E_ALL);
ini_set('display_errors',1);
?>
<pre style="font-size: 10px;">
  <?php print_r($session->get('user')); ?>
</pre>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
</head>
<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700|Merriweather:400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://cssgram-cssgram.netdna-ssl.com/cssgram.min.css">
<link rel="stylesheet" href="/css/main.css" charset="utf-8">
<body>
<?php include 'message.inc'; ?>
<main class="wrapper">
  <nav class="navigation">
		<section class="container">
			<a class="navigation-title" href="/">
				<h1 class="title">Photo Upload Service</h1>
			</a>
			<ul class="navigation-list float-right">
        <li class="navigation-item">
          <a class="navigation-link" href="/photos">All Photos</a>
        </li>
        <?php if (isset($session) && $session->get('user.loggedin')): ?>
          <li class="navigation-item">
            <a class="navigation-link" href="/photo/new">New Photo</a>
          </li>
          <li class="navigation-item">
            <a class="navigation-link" href="/user/<?php echo $session->get('user.id'); ?>">Account</a>
          </li>
          <li class="navigation-item">
            <a class="navigation-link" href="/user/logout">Logout</a>
          </li>
        <?php else: ?>
          <li class="navigation-item">
            <a class="navigation-link" href="/user/new">Sign up</a>
          </li>
          <li class="navigation-item">
          <a class="navigation-link" href="/user/login">Login</a>
        </li>
        <?php endif; ?>

			</ul>
		</section>
	</nav>
