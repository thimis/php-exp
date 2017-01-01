<?php

// Create the Database
function createDatabases($ip) {
  // MYSQL connection
  $mysql = new mysqli($ip, getenv("C9_USER"));

  // photoApp database
  $mysql->query("CREATE DATABASE IF NOT EXISTS photoApp");

};


// Create tables
function createTables($ip) {

  // MYSQL connections
  $photoApp = new mysqli($ip, getenv("C9_USER"), NULL, "photoApp");

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

  // Create 'likes' table query
  $likesTable = "CREATE TABLE IF NOT EXISTS likes (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    photo_id INT NOT NULL,
    user_id INT NOT NULL
  )";

  // Run create photos table query
  $photoApp->query($photoTable);

  // Run create users table query
  $photoApp->query($usersTable);

  // Run create users table query
  $photoApp->query($likesTable);
};


//$host= gethostname();
$ip = getenv("IP");
createDatabases($ip);
createTables($ip);
