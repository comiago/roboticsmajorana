<?php
$servername = "localhost";
$username = "root";
$password = "root";
$database = "roboticsmajorana";

$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
  die("Connection failed: " . $connection->connect_error);
}