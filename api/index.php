<?php 
  include_once 'storage/store.php';

  $servername = SERVERNAME;
  $username = USERNAME;
  $password = PASSWORD;
  $dbname = DB_NAME;
  
  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $query = "SELECT * FROM `opinion`";

  $result = $conn->query($sql);

  $json = [];
  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $data['name'] = $row['nama'];
      $data['opinion'] = $row['opini'];
      $data['rating'] = $row['rate'];
      $data['time'] = $row['timestamp'];
      $json[] = $data;
    }
  } else {
    echo "0 results";
  }

  echo json_encode($json, true);
  
  $conn -> close();
?>