<?php

include_once 'storage/store.php';
include_once 'functions/function.php';

// error_reporting(E_ALL);

// echo 'ok';
// echo "<br/>";
// echo $_SERVER['REQUEST_METHOD'];
// echo "<br/>";
$servername = SERVERNAME;
$username = USERNAME;
$password = PASSWORD;
$dbname = DB_NAME;

$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // echo 'post';

  date_default_timezone_set("Asia/Jakarta");

  // echo "<br/>";
  // echo $opinion;

  $name = mysqli_real_escape_string($conn, $_POST['testi-name']);
  $opinion = mysqli_real_escape_string($conn, $_POST['testi-opinion']);
  $rating = mysqli_real_escape_string($conn, $_POST['testi-rating']);
  $time = date("F d\, Y");

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $sql = "INSERT INTO `opinion` (`nama`, `opini`, `rate`, `timestamp`)
  VALUES ('$name', '$opinion', $rating, '$time')";

  // echo $sql;

  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    header("Location: https://michael-friska.com/");
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
} else {
  $query = "SELECT * FROM `opinion` ORDER BY `id` DESC";

  $result = $conn->query($query);

  $i = 1;
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Michael-Friska</title>

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:500" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web:700,900" rel="stylesheet">

    <!-- Custom stlylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="css/style.css" />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  </head>

  <body>
    <div class="container-md mt-5">
      <header class="header">
        <h1>Your Opinion</h1>
        <p>Please check whether your opinion has been inserted into our database. Your opinion should be on the first row.</p>
      </header>
      <section class="table-responsive">
        <table class="table table-hover table-striped align-middle">
          <thead class="table-light">
            <tr>
              <th>No.</th>
              <th>Name</th>
              <th>Opinion</th>
              <th>Rating</th>
              <th>Timestamp</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($result as $row) : ?>
              <tr>
                <td><?= $i++; ?></td>
                <td><?= cutStrings($row['nama'],100); ?></td>
                <td><?= cutStrings($row['opini'],100); ?></td>
                <td><?= $row['rate']; ?></td>
                <td><?= $row['timestamp']; ?></td>
              </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
      </section>
      <section>
        <div class="mt-5">
          <a type="button" class="btn btn-outline-info btn-lg" title="Michael-Friska" href="https://michael-friska.com">Back To Homepage</a>
        </div>
      </section>
    </div>
  </body>

  </html>
<?php
}

$conn->close();
?>