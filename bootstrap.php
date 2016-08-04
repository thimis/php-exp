<?php

// Create the Databases
function createDatabases($ip) {
  // MYSQL connection
  $mysql = new mysqli($ip, "root");

  // photoApp database
  $mysql->query("CREATE DATABASE IF NOT EXISTS photoApp");

  // userDB database
  $mysql->query("CREATE DATABASE IF NOT EXISTS userDB");
};


// Create tables
function createTables($ip) {

  // MYSQL connections
  $photoApp = new mysqli($ip, "root", NULL, "photoApp");
  $userDB = new mysqli($ip, "root", NULL, "userDB");

  // Create photos table query
  $photoTable = "CREATE TABLE IF NOT EXISTS photos (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    image VARCHAR(255) NOT NULL,
    title VARCHAR(255) NOT NULL,
    description VARCHAR(500) NOT NULL,
    filter VARCHAR(20) NOT NULL
  )";

  // Create users table query
  $usersTable = "CREATE TABLE IF NOT EXISTS users (
    id INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    password TEXT NOT NULL,
    last_login VARCHAR(100) NOT NULL,
    status VARCHAR(100) NOT NULL,
    UNIQUE KEY (email)
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=42";

  // Run create photos table query
  $photoApp->query($photoTable);

  // Run create users table query
  $userDB->query($usersTable);
};


$host= gethostname();
$ip = gethostbyname($host);
createDatabases($ip);
createTables($ip);
