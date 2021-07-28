<?php

include_once 'storage/store.php';

error_reporting(E_ALL);

// echo 'ok';
// echo "<br/>";
// echo $_SERVER['REQUEST_METHOD'];
// echo "<br/>";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // echo 'post';

  date_default_timezone_set("Asia/Jakarta");

  // echo "<br/>";
  // echo $opinion;
  
  $servername = SERVERNAME;
  $username = USERNAME;
  $password = PASSWORD;
  $dbname = DB_NAME;
  
  $conn = new mysqli($servername, $username, $password, $dbname);

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

  $conn->close();
}
else {
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
	<link type="text/css" rel="stylesheet" href="css/style.css" />

</head>

<body>

	<div id="notfound">
		<div class="notfound">
			<div class="notfound-404">
				<h1>404</h1>
			</div>
			<h2>Oops! This Page Could Not Be Found</h2>
			<p>Sorry but the page you are looking for does not exist, have been removed. name changed or is temporarily unavailable</p>
			<a title="Michael-Friska" href="https://michael-friska.com">Go To Homepage</a>
		</div>
	</div>

</body>

</html>
<?php } ?>