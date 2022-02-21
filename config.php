<?php
$servername = "localhost";
$username = "root";
$password = "root";
$database = "roboticsmajorana";

$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
  die("Connection failed: " . $connection->connect_error);
}

function getProjects(){
  global $connection;
  $query = 'SELECT * FROM project';
  return mysqli_query($connection, $query);
}

function getChapters($id){
  global $connection;
  $query = 'SELECT DISTINCT chapter.idChapter, chapter.name, chapter.description FROM chapter INNER JOIN project ON chapter.idProject = ' . $id;
  return mysqli_query($connection, $query);
}

function getParagraphs(){

}

function getSections(){

}
?>