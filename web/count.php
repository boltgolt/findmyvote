<?php

// Input variables
$voteID = $_GET['i'];

// Mysql variables
$servername = "localhost";
$username = "root";
$password = "root";
$database = "iot_votes";

// Connect to mysql
$conn = new mysqli($servername, $username, $password, $database);

// Check whether connection was succesful
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error . "<br>");
}

// Check whether everything has been inserted
if (isset($voteID)) {
  $sql = "UPDATE counts SET quantity = quantity + 1;";

  if ($conn->query($sql) === TRUE) {
    echo 'Hurray!';
  } else {
    echo 'Oops!';
  }

  if ($conn->query("UPDATE votes SET status = 1 WHERE vote_id='$voteID';") === TRUE) {
    echo 'Hurray!';
  } else {
    echo 'Oops!';
  }
}

?>
