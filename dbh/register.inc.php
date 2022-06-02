<?php

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $uid = $_POST['username'];
    $pwd = $_POST['password'];
    $passwordConfermation = $_POST['confirmPassword'];
    $role = $_POST['role'];
    $referent = $_POST['referent'];

    require 'administration.php';

    if(invalidUsername($uid) !== false){
        header('Location: ../register.php?error=invalidUsername');
        exit();
    }

    if(invalidEmail($email) !== false){
        header('Location: ../register.php?error=invalidEmail');
        exit();
    }

    if(passwordMatch($pwd, $passwordConfermation) !== false){
        header('Location: ../register.php?error=passwordDontMatch');
        exit();
    }

    if(usernameExists($uid, $email) !== false){
        header('Location: ../register.php?error=usernameExists');
        exit();
    }

    createUser($name, $surname, $email, $uid, $pwd, $role, $referent);
} else {
    header("Location: /register.php");
}