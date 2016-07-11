<?php
/* User model
 *
 * @TODO: Change flash messages for user specific messages
 * @TODO: Add form validation & sanitize input
 * @TODO: Handle session & cookies & tokens
 */


class User {

  protected static $connection;


  public function __construct() {
    include_once('../../lib/db.php');
    $this->db = new Db("userDB");
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
   * All Users
   *
   * @return {Boolean | Object} false on a failure and an array of users rows on success
   * @TODO: only get the fields that are needed, not password or anything sensitive
   */
   public function allUsers() {
     $rows = array();
     $query = 'SELECT id, email, first_name, last_name, last_login FROM users';
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
   * Single User
   *
   * @param {Integer} $id of the user to get from the database
   * @return {Boolean | Object} false on a failure and a single user on success
   * @TODO: only get the fields that are needed, not password or anything sensitive
   */
  public function singleUser($id) {
    $row = array();
    $query = 'SELECT id, email, first_name, last_name, last_login FROM users WHERE id = ' . $id;
    $res = $this->connect()->query($query);

    if ($res === false) {
      return false;
    }
    return $res->fetch_assoc();
  }

  /**
   * Create/Save user
   *
   * @param {Array} data to save in the database
   * Redirect after query
   */
  public function createUser($data) {

    $process = $this->processFormData($data);

    $email = $data['email'];
    $first_name = $data['first_name'];
    $last_name = $data['last_name'];
    $password = $data['password'];
    $confirm_password = $data['confirm_password'];
    $date = getdate()[0];
    $status = 'preactivated';

    if ($process) {
      $query = "INSERT INTO users(email, first_name, last_name, password, last_login, status) VALUES('$email', '$first_name', '$last_name', '$password', '$date', '$status')";
      // save the user to the database
      if ($this->connect()->query($query)) {
        header("Location: http://localhost/index.php?message=saved", true, 302);
      } else {
        header("Location: http://localhost/index.php?message=notsaved", true, 302);
      }
    }

  }

   /**
    * Edit User
    *
    * @param {Array} data to update in the database
    * @return {String} status message
    */
    public function updateUser($data) {
      $id = $data['id'];
      $email = $data['email'];
      $first_name = $data['first_name'];
      $last_name = $data['last_name'];
      $password = $data['password'];

      $query = "UPDATE users SET email='" . $email . "', first_name='" . $first_name . "', last_name='" . $last_name . "', password='" . $password . "' WHERE id=" . $id;
      // save the photo entry to the database

      if ($this->connect()->query($query)) {
        header("Location: http://localhost/api/photo.php?message=editSuccess&id=" . $id, true, 302);
      } else {
        header("Location: http://localhost/api/photo.php?message=editFail&id=" . $id, true, 302);
      }
    }

  /**
   * Delete User
   *
   * @param {id} id of the user to delete
   * @return {String} status message
   */
   public function deleteUser($id) {
     $query = 'DELETE FROM users WHERE id =' . $id;
     $res = $this->connect()->query($query);

     if ($res === false) {
       return 'deleteFail';
     }
     return 'deleteSuccess';
   }


   private function processFormData($form) {
     $ret = $form;

     // Handle empty email or password
     if (empty($form['email']) || empty($form['password']) || empty($form['confirm_password'])) {
       header("Location: http://localhost/index.php?message=emptyfield", true, 302);
     } elseif (!($form['password'] == $form['confirm_password'])) {
       header("Location: http://localhost/index.php?message=passwordMismatch", true, 302);
     } elseif ($this->connect()->query('SELECT * FROM users WHERE email = "' . $form["email"] . '"')->num_rows > 0) {
      header("Location: http://localhost/index.php?message=emailTaken", true, 302);
    } else {
      return true;
    }
  }
}
