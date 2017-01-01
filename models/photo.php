<?php

class Photo {

  protected static $connection;


  public function __construct() {
    include_once('/home/ubuntu/workspace/lib/db.php');
    $this->db = new Db("photoApp");
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
      echo 'Connection unsuccessful';
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
     $res = $this->db->query($query);

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
    $query = 'SELECT * FROM photos WHERE id = ' . $id . ';';

    $res = $this->db->query($query);

    if ($res === false) {
      return false;
    }
    $res = $res->fetch_assoc();
    $res['user'] = $this->getUser($res['user_id']);
    return $res;
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
    $filter = 'none';
    $user_id = $data['user_id'];

    if (!$this->isImage($tmp)) {
      header("Location: /photo/new?message=notImage", true, 302);
    }

    if (empty($title) ||
        empty($description) ||
        empty($image)
    ) {
      header("Location: /photo/new?message=emptyfield", true, 302);
    }

    // Save the file to disk
    move_uploaded_file($tmp, '/home/ubuntu/workspace/public/images/' . $image);

    $query = "INSERT INTO photos(image, title, description, filter, user_id) VALUES('$image', '$title', '$description', '$filter', '$user_id')";
    // save the photo entry to the database
    if ($this->db->query($query)) {
      header("Location: /index.php?message=saved", true, 302);
    } else {
      header("Location: /index.php?message=notsaved", true, 302);
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
      $filter = $data['filter'];

      if (!$this->isImage($image)) {
        header("Location: /index.php?message=notImage", true, 302);
      }

      $query = "UPDATE photos SET title='" . $title . "', description='" . $description . "', filter='" . $filter . "' WHERE id=" . $id;
      // save the photo entry to the database

      if ($this->db->query($query)) {
        header("Location: /api/photo.php?message=editSuccess&id=" . $id, true, 302);
      } else {
        header("Location: /api/photo.php?message=editFail&id=" . $id, true, 302);
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
     $res = $this->db->query($query);

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

  /**
   * getUser
   *
   * @param {Number} $user_id is the id of the user that posted the image
   * @return {Array} $ret return an array with user information
   */
  private function getUser($user_id) {
    include_once('/home/ubuntu/workspace/models/user.php');
    $UserClass = new User();
    $user = $UserClass->singleUser($user_id);
    $ret['name'] = $user['first_name'] . ' ' . $user['last_name'];
    $ret['email'] = $user['email'];
    $ret['id'] = $user_id;
    return $ret;
  }

  /**
   * Like
   *
   * A user can like another user's photo
   * @param {Number} $user_id of the user liking the photo
   * @param {Number} $photo_id of the photo being liked
   */
  public function like($user_id, $photo_id) {
    $query = "INSERT INTO likes(user_id, photo_id) VALUES('$user_id', '$photo_id')";

    $res = $this->db->query($query);

    return array(
      "response" => "User " . $user_id . " liked photo " . $photo_id,
      "db_response" => $res,
    );
  }
}
