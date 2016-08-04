<?php
  include_once('/app/includes/header.inc');
?>

<div class="container">

    <form enctype="multipart/form-data" action="/photo/create" method="POST">

      <!-- File Filed -->
      <div class="button btn--upload fileUpload">
        <span>Upload Image</span>
        <input class="upload" type='file' name='userFile'>
      </div>


      <!-- Title/Description fields -->

        <label for="title">Title:</label>
        <input type="text" id="title" placeholder="Message" name="title" value="">

        <label for="description">Description:</label>
        <textarea type="text" id="" placeholder="Description" name="description" rows="6"></textarea>

        <!-- Hidden user_id field -->
        <input type="hidden" name="user_id" value="<?php echo $session->get('user.id'); ?>">

      <!-- Submit Button -->
      <button type="submit" class="button button-outline">Submit</button>

    </form>

</div>

<?php include_once('/app/includes/footer.inc'); ?>
