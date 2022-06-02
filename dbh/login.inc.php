<?php

if(isset($_POST['submit'])){
    $uid = $_POST['username'];
    $pwd = $_POST['password'];

    require 'administration.php';

    loginUser($uid, $pwd);
} else {
    header("Location: /login.php");
}