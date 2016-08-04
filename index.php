<?php
  include_once('/app/includes/header.inc');
  include_once('/app/lib/db.php');
  include_once('/app/models/photo.php');
?>

  <header class="header" id="home">
  	<section class="container">
  		<h1 class="title">Photo Uploader</h1>
  		<p class="description">A simple photo uploading site <br><i><small>Currently v1.0</small></i></p>
  		<a class="button" href="/photo/new">Start Uploading</a>
  	</section>
  </header>

  <section class="header">
  	<div class="container">
  		<h1 class="title">Create a user today</h1>
  		<p class="description">This account will allow you to upload and add filters to your photos</p>
  		<a class="button" href="/user/new">Create Account</a>
  	</div>
  </section>



<?php include_once('/app/includes/footer.inc'); ?>
