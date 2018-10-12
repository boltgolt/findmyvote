<?php

// Input variables
$voteID = $_GET['i'];
$voteParty = $_GET['p'];

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
if (isset($voteID) && isset($voteParty)) {
	$sql = "INSERT INTO votes (vote_id, vote_party, status) VALUES ('$voteID', '$voteParty', 0) ON DUPLICATE KEY UPDATE vote_id='$voteID', vote_party='$voteParty', status=0";

  if ($conn->query($sql) === TRUE) {
    echo 'Hurray!';
  } else {
    echo 'Oops!';
  }
}

?>
