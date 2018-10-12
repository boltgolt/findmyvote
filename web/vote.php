<?php

header('Content-Type: application/json');

// Mysql variables
$servername = "localhost";
$username = "root";
$password = "root";
$database = "iot_votes";

// Connect to mysql
$conn = new mysqli($servername, $username, $password, $database);

// Variables gained from requests
$voteID = mysqli_escape_string($conn, $_GET['id']);

// Check whether connection was succesful
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error . "<br>");
}

// Check whether an ID has been inserted
if (isset($voteID)) {
  $sql = "SELECT vote_id, status, vote_party FROM votes WHERE vote_id='$voteID'";
  $result = $conn->query($sql);

  // Create json output
  $rows[] = array();
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $rows[] = $row;
      if ($row['status'] >= 3) {
        // If there is a reason to give statistics, do so
        $partyChosen = $row['vote_party'];
        $sql2 = "SELECT count(*) as totalChosen FROM votes WHERE vote_party='$partyChosen'";
        $result2 = $conn->query($sql2);
        $dataChosen = $result2->fetch_assoc();

        // Calculate the percentage
        $result3 = $conn->query("SELECT count(*) as total FROM votes");
        $data = $result3->fetch_assoc();

        $percentage = round(($dataChosen['totalChosen'] / $data['total']) * 100,1);
        $rows[1]['proc'] = $percentage;;
      }
    }
    print json_encode($rows[1]);
  }
}

?>