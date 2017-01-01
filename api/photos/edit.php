<?php
  include_once('/home/ubuntu/workspace/includes/header.inc');
  include_once('/home/ubuntu/workspace/lib/db.php');
  include_once('/home/ubuntu/workspace/models/photo.php');

  $id = $_GET['id'];
  $PhotoClass = new Photo();
  $photo = $PhotoClass->singlePhoto($id);

  if (!($session->get('user.id') == $photo['user_id'])) {
    header("Location: /photos?message=notAllowed", true, 302);
  }
?>



<div class="container">

  <div class="row">
    <div class="column">
      <nav id="filters">
        <a class="button button-outline" href="#filters" data-filter="none">None</a>
        <a class="button button-outline" href="#filters" data-filter="reyes">Reyes</a>
        <a class="button button-outline" href="#filters" data-filter="perpetua">Perpetua</a>
        <a class="button button-outline" href="#filters" data-filter="toaster">Toaster</a>
        <a class="button button-outline" href="#filters" data-filter="walden">Walden</a>
        <a class="button button-outline" href="#filters" data-filter="aden">Aden</a>
        <a class="button button-outline" href="#filters" data-filter="inkwell">Inkwell</a>
        <a class="button button-outline" href="#filters" data-filter="xpro2">Xpro II</a>
        <a class="button button-outline" href="#filters" data-filter="nashville">Nashville</a>
      </nav>
    </div>
  </div>

  <div class="row">
    <div class="column">
      <form enctype="multipart/form-data" action="/photo/<?php echo $photo['id']; ?>/update" method="POST">

        <!-- Hidden id field -->
        <input type="hidden" name="id" value="<?php echo $photo['id']; ?>">

        <!-- Hidden filter field -->
        <input id="filterInput" type="hidden" name="filter" value="">

        <!-- Hidden image field -->
        <input type="hidden" name="image" value="<?php echo $photo['image']; ?>">

        <!-- Image -->
        <figure id="image" class="<?php echo $photo['filter']; ?>">
          <img src="/images/<?php echo $photo['image']; ?>" />
        </figure>


        <!-- Title/Description fields -->
          <label for="title">Title:</label>
          <input type="text" class="form-control" id="title" placeholder="Message" name="title" value="<?php echo $photo['title']; ?>">

          <label class="f2 mb2 db" for="description">Description:</label>
          <textarea class="db w-100" type="text" class="form-control" id="message" placeholder="Description" name="description" rows="6"><?php echo $photo['description']; ?></textarea>

        <!-- Submit Button -->
        <button type="submit" class="button button-outline">Submit</button>
      </form>
    </div>
  </div>
</div>
<?php include_once('/home/ubuntu/workspace/includes/footer.inc'); ?>
