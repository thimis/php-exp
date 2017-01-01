<?php
/* User model
 *
 * @TODO: Change flash messages for user specific messages
 *
 *
 */

class User {

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
   * Single User
   *
   * @param {Integer} $id of the user to get from the database
   * @return {Boolean | Object} false on a failure and a single user on success
   * @TODO: only get the fields that are needed, not password or anything sensitive
   */
  public function singleUser($id) {
    $row = array();
    $query = 'SELECT id, email, first_name, last_name, last_login FROM users WHERE id = ' . $id;

    $res = $this->db->query($query);

    if ($res === false) {
      return false;
    }
    return $res->fetch_assoc();
  }


  /**
   * Email to Id
   *
   * @param {String} $email of the user to get from the database
   * @return {Boolean | Object} false on a failure and a single user on success
   * @TODO: only get the fields that are needed, not password or anything sensitive
   */
  public function emailToId($email) {
    $row = array();
    $query = 'SELECT id FROM users WHERE email = "' . $email . '"';

    $res = $this->db->query($query);

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
  public function createUser($data, $session) {

    $process = $this->processFormData($data);
    $email = $data['email'];
    $first_name = $data['first_name'];
    $last_name = $data['last_name'];
    $passwordRaw = $data['password'];
    $password = $this->encryptPassword($passwordRaw);
    $confirm_password = $data['confirm_password'];
    $date = getdate()[0];
    $status = 'preactivated';

    if ($process) {
      $query = "INSERT INTO users(email, first_name, last_name, password, last_login, status) VALUES('$email', '$first_name', '$last_name', '$password', '$date', '$status')";
      // save the user to the database
      if ($this->db->query($query)) {
        $session->put('user', $this->singleUser($this->db->currentId()));
        $session->put('user.loggedin', true);
        header("Location: /index.php?message=saved");
      } else {
        header("Location: /index.php?message=notsaved");
      }
    }

  }

  /**
   * Edit User
   *
   * @param {Array} data to update in the database
   * @return {String} status message
   */
   public function updateUser($data, $session) {
     $id = $data['id'];
     $email = $data['email'];
     $first_name = $data['first_name'];
     $last_name = $data['last_name'];
     $password = $this->encryptPassword($data['password']);

     $query = "UPDATE users SET email='" . $email . "', first_name='" . $first_name . "', last_name='" . $last_name . "', password='" . $password . "' WHERE id=" . $id;
     // save the photo entry to the database

     if ($this->db->query($query)) {
       $session->put('user.email', $email);
       $session->put('user.first_name', $first_name);
       $session->put('user.last_name', $last_name);
       header("Location: /api/photo.php?message=editSuccess&id=" . $id, true, 302);
     } else {
       header("Location: /api/photo.php?message=editFail&id=" . $id, true, 302);
     }
   }

 /**
  * Delete User
  *
  * @param {id} id of the user to delete
  * @return {String} status message
  */
  public function deleteUser($id, $session) {
    $query = 'DELETE FROM users WHERE id =' . $id;
    $res = $this->db->query($query);

    if ($res === false) {
      return 'deleteFail';
    }
    $session->forget();
    return 'deleteSuccess';
  }

  /**
   * User Login
   * @param {Array} $credentials is the user's login information from the form
   */
  public function login($credentials, $session) {

    $password = $credentials['password'];
    $id = $this->emailToId($credentials['email'])['id'];
    $hashed = $this->getUserPass($id);

    if (password_verify($password, $hashed)) {
      $session->put('user', $this->singleUser($id));
      $session->put('user.loggedin', true);
      return true;
    } else {
      return false;
    }
  }


   /**  PRIVATE FUNCTIONS
    *
    *
    */

  /**
   * Process Form Data
   * @param {Array} $form data to be processed from the signup page
   * @return {Boolean} reroute if false otherwise return true
   */
  private function processFormData($form) {
    $ret = $form;

    // Handle empty email or password
    if (empty($form['email']) || empty($form['password']) || empty($form['confirm_password'])) {
      header("Location: /index.php?message=emptyfield", true, 302);
     } elseif (!($form['password'] == $form['confirm_password'])) {
      header("Location: /index.php?message=passwordMismatch", true, 302);
    } elseif ($this->db->query('SELECT * FROM users WHERE email = "' . $form["email"] . '"')->num_rows > 0) {
      header("Location: /index.php?message=emailTaken", true, 302);
    } else {
      return true;
    }
  }

 /**
  * Encrypt Password
  * @param {String} $raw plaintext password
  * @return {String} encrypted password
  */
  private function encryptPassword($raw) {
    $salt = uniqid(mt_rand(), true);
    $options = array(
      'salt' => $salt,
      'cost' => 12 // default is 10
    );
    $password = password_hash($raw, PASSWORD_DEFAULT);
    return $password;
  }

  private function getUserPass($id) {
    $row = array();
    $query = 'SELECT password FROM users WHERE id = ' . $id;
    $res = $this->db->query($query);

    if ($res === false) {
      return false;
    }
    return $res->fetch_assoc()['password'];
  }
}
