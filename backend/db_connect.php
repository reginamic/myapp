<?php
$servername = "localhost";
$username = "root";  // default user
$password = "";      // default password is empty
$dbname = "Skillpro";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>