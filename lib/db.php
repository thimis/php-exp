<?php

class Db {

  protected static $connection;

  /**
   * Connect to the database
   * @return {Boolean | Object} false on a failure and a MySQLi object on success
   */
  public function connect() {
    // Try to connect
    if (!isset(self::$connection)) {
      self::$connection = new mysqli("localhost", "root", NULL, "photoApp");
    }

    // If the connection is not successful, handle error.
    if (self::$connection === false) {
      // Handle error here
      return false;
    }
    return self::$connection;
  }

  /**
   * General query function
   *
   * @param {String} $query is the SQL query
   * @return {Mixed} result of the mysqli::query() function
   */
   public function query($query) {
     // Connect
     $connection = $this->connect();

     // Perform the query
     $ret = $connection->query($query);

     return $ret;
   }

  /**
   * Select All
   *
   * @param {String} $table to select from
   * @return {Boolean | Object} false on a failure and an array of database rows on success
   */
   public function selectAll($table) {
     $rows = array();
     $query = 'SELECT * FROM ' . $table;
     $res = $this->query($query);

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
   * Fetch the last error from the database
   *
   * @return string Database error message
   */
   public function error() {
     $connection = $this->connect();
     return $connection->error;
   }


}
