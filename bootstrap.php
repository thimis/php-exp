<?php

// Create the Databases
function createDatabases($ip) {
  // MYSQL connection
  $mysql = new mysqli($ip, "root");

  // photoApp database
  if ($mysql->query("CREATE DATABASE IF NOT EXISTS photoApp")) {
    echo "photoApp database created!\n";
  }

  // userDB database
  if ($mysql->query("CREATE DATABASE IF NOT EXISTS userDB")) {
    echo "userDB database created!\n";
  }
};


// Create tables
function createTables($ip) {

  // MYSQL connections
  $photoApp = new mysqli($ip, "root", NULL, "photoApp");
  $userDB = new mysqli($ip, "root", NULL, "userDB");

  // Create photos table query
  $photoTable = "CREATE TABLE IF NOT EXISTS photos (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
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
    satus VARCHAR(100) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=42";


  // Run create photos table query
  if ($photoApp->query($photoTable)) {
    echo "Photo table Created!\n";
  } else {
    echo "Photo table not created\n";
  }

  // Run create users table query
  if ($userDB->query($usersTable)) {
    echo "Users table Created!\n";
  } else {
    echo "Users table not created\n";
  }
};

$host= gethostname();
$ip = gethostbyname($host);
createDatabases($ip);
createTables($ip);
