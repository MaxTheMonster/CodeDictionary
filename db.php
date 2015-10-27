<?php 

  $host = 'localhost'; // Host name
  $username = "root"; // Mysql username
  $password = ""; // Mysql password
  $db_name = "codedictionary"; // Database name
  
  // Connect to server and select database.
$link = mysqli_connect($host, $username, $password, $db_name);

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }