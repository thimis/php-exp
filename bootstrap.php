<?php

$host= gethostname();
$ip = gethostbyname($host);

$mysql = new mysqli($ip, "root");

if ($mysql->query("CREATE DATABASE photoApp")) {
  echo "Database created!\n";
}

$mysql2 = new mysqli($ip, "root", NULL, "photoApp");

$createTable = "CREATE TABLE photos (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  image VARCHAR(255) NOT NULL,
  title VARCHAR(255) NOT NULL,
  description VARCHAR(500) NOT NULL
)";
if ($mysql2->query($createTable)) {
  echo "Table Created!\n";
} else {
  echo "Table not created\n";
}
