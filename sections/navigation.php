<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../stylesheets/style.min.css">
    <link rel="stylesheet" href="http://use.fontawesome.com/releases/v6.0.0/css/all.css" integrity="sha384-3B6NwesSXE7YJlcLI9RpRqGf2p/EgVH8BgoKTaUrmKNDkHPStTQ3EyoYjCGXaOTS" crossorigin="anonymous">
    <title>Document</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "montserrat";
        }

        body{
            min-height: 100vh;
            overflow-x: hidden;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="navigation">
            <ul>
                <li class="siteTitle">
                    <a href="index.php">
                        <span class="icon"><i class="fa fa-robot"></i></span>
                        <span class="title">Robotics Majorana</span>
                    </a>
                </li>
                <li class="clicked">
                    <a href="#">
                        <span class="icon"><i class="fa-solid fa-house"></i></span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a id="pages">
                        <span class="icon"><i class="fa-solid fa-file-lines"></i></span>
                        <span class="title">Pages</span>
                    </a>
                </li>
                <li>
                    <a>
                        <span class="icon"><i class="fa-solid fa-lightbulb"></i></span>
                        <span class="title">Projects</span>
                    </a>
                </li>
                <li>
                    <a>
                        <span class="icon"><i class="fa-solid fa-bookmark"></i></span>
                        <span class="title">Chapters</span>
                    </a>
                </li>
                <li>
                    <a>
                        <span class="icon"><i class="fa-solid fa-paragraph"></i></span>
                        <span class="title">Paragraphs</span>
                    </a>
                </li>
                <li>
                    <a>
                        <span class="icon"><i class="fa-solid fa-users"></i></span>
                        <span class="title">Profiles</span>
                    </a>
                </li>
                <li>
                    <a>
                        <span class="icon"><i class="fa-solid fa-arrow-right-from-bracket"></i></span>
                        <span class="title">LogOut</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="main">
        <div class="topbar">
            <div class="toggle"><i class="fa-solid fa-bars"></i></div>
            <div class="search">
                <label>
                    <input type="text" placeholder="Search here">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </label>
            </div>
            <div class="user">
                <img src="https://picsum.photos/200/200">
            </div>
        </div>