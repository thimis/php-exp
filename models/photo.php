<?php

class Photo {

  protected static $connection;


  public function __construct() {
    include_once(dirname('.') . '/lib/db.php');
    $this->db = new Db();
  }

  /**
   * Connect to the database
   * @return {Boolean | Object} false on a failure and a Db object on success
   */
  public function connect() {
    // Try to connect
    if (!isset(self::$connection)) {
      self::$connection = $this->db;
    }

    // If the connection is not successful, handle error.
    if (self::$connection === false) {
      // Handle error here
      return false;
    }
    return self::$connection;
  }

  /**
   * All Photos
   *
   * @return {Boolean | Object} false on a failure and an array of photos rows on success
   */
   public function allPhotos() {
     $rows = array();
     $query = 'SELECT * FROM photos';
     $res = $this->connect()->query($query);

     if ($res === false) {
       return false;
     }

     // Format query data
     while ($row = $res->fetch_assoc()) {
       $rows[] = $row;
     }
     return $rows;
  }

  /**
   * Single Photo
   *
   * @param {Integer} $id of the photo to get from the database
   * @return {Boolean | Object} false on a failure and a single photo on success
   */
  public function singlePhoto($id) {
    $row = array();
    $query = 'SELECT * FROM photos WHERE id = ' . $id;
    $res = $this->connect()->query($query);

    if ($res === false) {
      return false;
    }
    return $res->fetch_assoc();
  }

  /**
   * Create/Save photo
   *
   * @param {Array} data to save in the database
   * Redirect after query
   */
  public function savePhoto($data) {
    $title = $data['title'];
    $description = $data['description'];
    $image = $data['image'];
    $tmp = $data['temp'];

    if (!$this->isImage($tmp)) {
      header("Location: http://localhost/index.php?message=notImage", true, 302);
      return false;
    }

    if (empty($title) ||
        empty($description) ||
        empty($image)
    ) {
      header("Location: http://localhost/index.php?message=emptyfield", true, 302);
    }

    // Save the file to disk
    move_uploaded_file($tmp, '/app/images/' . $image);

    $query = "INSERT INTO photos(image, title, description) VALUES('$image', '$title', '$description')";
    // save the photo entry to the database
    if ($this->connect()->query($query)) {
      header("Location: http://localhost/index.php?message=saved", true, 302);
    } else {
      header("Location: http://localhost/index.php?message=notsaved", true, 302);
    }
  }

   /**
    * Edit photo
    *
    * @param {Array} data to update in the database
    * @return {String} status message
    */
    public function updatePhoto($data) {
      $title = $data['title'];
      $description = $data['description'];
      $id = $data['id'];
      $image = $data['image'];

      if (!$this->isImage($image)) {
        header("Location: http://localhost/index.php?message=notImage", true, 302);
      }

      $query = "UPDATE photos SET title='" . $title . "', description='" . $description . "' WHERE id=" . $id;
      // save the photo entry to the database

      if ($this->connect()->query($query)) {
        header("Location: http://localhost/api/photo.php?message=editSuccess&id=" . $id, true, 302);
      } else {
        header("Location: http://localhost/api/photo.php?message=editFail&id=" . $id, true, 302);
      }
    }

  /**
   * Delete
   *
   * @param {id} id of the photo to delete
   * @return {String} status message
   */
   public function deletePhoto($id) {
     $query = 'DELETE FROM photos WHERE id =' . $id;
     $res = $this->connect()->query($query);

     if ($res === false) {
       return 'deleteFail';
     }
     return 'deleteSuccess';
   }

  /**
   * isImage
   *
   * @param {String} $path path/to/image
   * @return {Boolean} if the image checks out return true
  */
  private function isImage($path) {
    if (exif_imagetype($path) === false) {
      return false;
    }

    return true;
  }
}
