<?php
            require('config.php');
            $projects = getprojects();
            while($project = mysqli_fetch_array($projects)){
                echo '<li class="dropdown">'.$project['name'].'<ul>';
                $chapters = getChapters($project['idProject']);
                while($chapter = mysqli_fetch_array($chapters)){
                    echo '<li><a href="">'.$chapter["name"].'</a></li><hr>';
                }

                echo '</ul></li><hr>';
            }
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesheets/style.min.css">
    <title>Document</title>
</head>
<body>
    <nav class="nav">
        <div class="menuIcon">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <h1 class="title">Robotics Documentation</h1>
        <div class="auth">
            <a href="" id="login">Login</a>
            or
            <a href="register.html">Register</a>
        </div>
    </nav>
    <ul class="menu">
        <div class="search">
            <input type="text" placeholder="Search.." name="search">
            <button type="submit">cerca</button>
        </div>
        <hr>
        <li class="active"><a href="">Home</a></li>
        <hr>

    </ul>
    <div class="content">


    <!-- 
        <li class="dropdown">Dropdown
            <ul>
                <li><a href="">Home</a></li>
                <hr>
            </ul>
        </li>
        <hr> 
    -->