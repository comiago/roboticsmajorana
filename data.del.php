<?php
$servername = "localhost";
$username = "root";
$password = "root";
$database = "roboticsmajorana";

$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
  die("Connection failed: " . $connection->connect_error);
}

$query = 'SELECT group_concat(file.name) as names FROM section LEFT JOIN picture ON section.picture = picture.idPicture LEFT JOIN sectionfile ON sectionfile.section = section.idSection LEFT JOIN file ON file.idFile = sectionfile.file WHERE section.paragraph = 25 GROUP BY section.idSection;';
$result = mysqli_query($connection, $query);
while ($chapter = mysqli_fetch_array($result)){
}
$arr = "file1,file2";
print_r(explode(',', $arr));
?>