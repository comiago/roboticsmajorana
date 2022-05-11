<?php
$servername = "localhost";
$username = "root";
$password = "root";
$database = "prova";

$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
  die("Connection failed: " . $connection->connect_error);
}

$ip = $_SERVER['REMOTE_ADDR'];

$query = "SELECT * FROM visit where ip = '$ip'";
$result = mysqli_query($connection, $query);
$totalVisitors = mysqli_num_rows($result);

if ($totalVisitors == 0) {
    $query = "INSERT INTO visit(ip) VALUES('$ip')";
    $result = mysqli_query($connection, $query);
}


$query = "SELECT * FROM visit";
$result = mysqli_query($connection, $query);
$totalVisitors = mysqli_num_rows($result);

?>

<h1>Total visits: <?php echo $totalVisitors ?></h1>