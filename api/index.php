<?php 
  include_once '../storage/store.php';
  
  header("Content-type:application/json");
  
  $servername = SERVERNAME;
  $username = USERNAME;
  $password = PASSWORD;
  $dbname = DB_NAME;
  
  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $query = "SELECT * FROM `opinion`";

  $result = $conn->query($query);

  if ($result->num_rows > 0) {
    $json = [];
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $data['name'] = $row['nama'];
      $data['opinion'] = $row['opini'];
      $data['rating'] = $row['rate'];
      $data['time'] = $row['timestamp'];
      $json[] = $data;
    }
    echo json_encode($json, true);
  } else {
    echo "0 results";
  }
  
  $conn -> close();
?>