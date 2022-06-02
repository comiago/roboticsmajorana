<?php

require('connection.php');

if($_POST['function'] ?? null){
  echo $_POST['function']();
}

function getProjects(){
  global $connection;
  $query = 'SELECT idProject, name FROM project';
  $result = mysqli_query($connection, $query);
  $index = 0;
  $output = '<h1 style="margin-top: 20px">Projects</h1>';
  while ($project = mysqli_fetch_array($result)){
    if ($index == 0){
      $output .= '<p class="selectedFirstColumn first-col-element" identifier="'.$project['idProject'].'">'.$project['name'].'</p>';
    } else{
      $output .= '<p class="first-col-element" identifier="'.$project['idProject'].'">'.$project['name'].'</p>';
    }
    $index++;
  }
  echo $output;
}

function getChapters(){
  global $connection;
  $query = 'SELECT DISTINCT idChapter, name FROM chapter WHERE project = ' . $_POST["project"];
  $result = mysqli_query($connection, $query);
  $index = 0;
  $output = '<h1 style="margin-top: 20px">Chapters</h1>';
  while ($chapter = mysqli_fetch_array($result)){
    if ($index == 0){
      $output .= '<p class="selectedSecondColumn second-col-element" identifier="'.$chapter['idChapter'].'">'.$chapter['name'].'</p>';
    } else{
      $output .= '<p class="second-col-element" identifier="'.$chapter['idChapter'].'">'.$chapter['name'].'</p>';
    }
    $index++;
  }
  echo $output;
}

function getParagraphs(){
  global $connection;
  $query = 'SELECT DISTINCT idParagraph, name FROM paragraph WHERE chapter = ' . $_POST["chapter"];
  $result = mysqli_query($connection, $query);
  $index = 0;
  $output = "";
  while ($paragraph = mysqli_fetch_array($result)){
    if ($index == 0){
      $output .= '<div class="third-nav-col">';
    } elseif($index % 6 == 0){
      $output .= '</div><div class="third-nav-col">';
    }
    $output .= '<p class="paragraph" identifier="'.$paragraph['idParagraph'].'">'.$paragraph['name'].'</p>';
    $index++;
  }
  if ($index % 6 != 0){
    $output .= '</div>';
  }
  echo $output;
}

function getSections(){
  global $connection;
  $query = 'SELECT section.name, section.text, picture.path AS picturePath, group_concat(file.name) AS fileNames, group_concat(file.path) AS filePaths FROM section LEFT JOIN picture ON section.picture = picture.idPicture LEFT JOIN sectionfile ON sectionfile.section = section.idSection LEFT JOIN file ON file.idFile = sectionfile.file WHERE section.paragraph = '.$_POST["paragraph"].' GROUP BY section.idSection; ';
  $result = mysqli_query($connection, $query);
  $output = "";
  while ($paragraph = mysqli_fetch_array($result)){
    $output .= '<secion class="section"><div class="sectionContent"><h2>'.$paragraph["name"].'</h2><p>'.$paragraph["text"].'</p>';
    $names = explode(",", $paragraph["fileNames"] ?? '');
    $paths = explode(",", $paragraph["filePaths"] ?? '');
    if ($names[0] != ''){
      $output .= '<div class="files"><h3>Related files</h3>';
      for ($i = 0; $i < sizeof($names); $i++){
        $output .= '<a href="'.$paths[$i].'" class="file"><i class="fa-solid fa-file-zipper"></i>'.$names[$i].'</a>';
      }
      $output .= '</div>';
    }
    $output .= '</div>';
    if($paragraph["picturePath"]){
      $output .= '<img src="'.$paragraph['picturePath'].'" alt="" class="sectionImage">';
    }
    $output .= '</secion><hr>';
  }
  echo $output;
}

