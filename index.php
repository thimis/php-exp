<?php
  include_once(dirname('.') . '/includes/header.inc');
  include_once(dirname('.') . '/lib/db.php');
  include_once(dirname('.') . '/models/photo.php');
?>

  <header class="header" id="home">
  	<section class="container">
  		<h1 class="title">Photo Uploader</h1>
  		<p class="description">A simple photo uploading site <br><i><small>Currently v1.0</small></i></p>
  		<a class="button" href="/photo/new">Start Uploading</a>
  	</section>
  </header>


<?php include_once(dirname('.') . '/includes/footer.inc'); ?>
