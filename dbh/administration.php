<?php

require('connection.php');

if($_POST['function'] ?? null){
    echo $_POST['function']();
}

function getRoles(){
    global $connection;
    $query = "SELECT * FROM role";
    return mysqli_query($connection, $query);
}

function getReferents(){
    global $connection;
    $query = "SELECT user.idUser, user.name, user.surname FROM user INNER JOIN role ON user.role = role.idRole WHERE role.name = 'Administrator'";
    return mysqli_query($connection, $query);
}

function invalidUsername($uid){
    if(!preg_match('/^[a-zA-Z0-9]{3,20}$/', $uid)){
         true;
    } else {
        return false;
    }
}

function invalidEmail($email){
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        return true;
    } else {
        return false;
    }
}

function passwordMatch($pwd, $passwordConfirmation){
    if($pwd !== $passwordConfirmation){
        return true;
    } else {
        return false;
    }
}

function usernameExists($uid, $email){
    global $connection;
    $query = "SELECT * FROM user WHERE username = ? OR email = ?";
    $stmt = mysqli_stmt_init($connection);
    if(!mysqli_stmt_prepare($stmt, $query)){
        header('Location: ../register.php?error=sqlError');
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $uid, $email);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($result)){
        return $row;
    } else {
        return false;
    }

    mysqli_stmt_close($stmt);
}

function createUser($name, $surname, $email, $uid, $pwd, $role, $referent){
    global $connection;
    $query = "INSERT INTO user (name, surname, email, username, password, role, referent) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($connection);
    if(!mysqli_stmt_prepare($stmt, $query)){
        header('Location: ../sections/registered.php');
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sssssss", $name, $surname, $email, $uid, $hashedPwd, $role, $referent);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header('Location: ../registered.php');
    exit();
}

function loginUser($uid, $pwd){
    $userExists = usernameExists($uid, $uid);

    if($userExists === false){
        header('Location: ../login.php?error=wrongLogin');
        exit();
    }

    $pwdHashed = $userExists['password'];

    $check = password_verify($pwd, $pwdHashed);

    if($check === false){
        header('Location:../login.php?error=wrongLogin');
        exit();
    } else if($check === true){
        session_start();
        $_SESSION["id"] = $userExists['idUser'];
        $_SESSION["username"] = $userExists['username'];
        header('Location:../dashboard.php');
        exit();
    }
}

// DASHBOARD

function getPages(){
    global $connection;
    $query = "SELECT * FROM page";
    $result = mysqli_query($connection, $query);
    $output = "";
    $output .= '<div class="details"><div class="recentActivities"><div class="cardHeader"><h2>Pages</h2></div><table><thead><tr><td>Name</td><td>Last Modify</td><td>User</td><td>Status</td></tr></thead><tbody>';
    while ($page = mysqli_fetch_array($result)){
        $output .= '<tr><td>' . $page['name'] . '</td></tr>';
    }
    $output .= '</tbody></table></div></div>';
    echo $output;
}

function getProjects(){
    global $connection;
    $query = "SELECT * FROM project";
    $result = mysqli_query($connection, $query);
    $output = "";
    $output .= '<div class="details"><div class="recentActivities"><div class="cardHeader"><h2>Projects</h2></div><table><thead><tr><td>Name</td><td>Last Modify</td><td>User</td><td>Status</td></tr></thead><tbody>';
    while ($project = mysqli_fetch_array($result)){
        $output .= '<tr><td>' . $project['name'] . '</td></tr>';
    }
    $output .= '</tbody></table></div></div>';
    echo $output;
}