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

function checkEmail(){
    global $connection;
    $query = "SELECT COUNT(*) AS count FROM user WHERE email = '" . $_POST['email'] . "'";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($result);
    echo $row['count'];
}

function checkUsername(){
    global $connection;
    $query = "SELECT COUNT(*) AS count FROM user WHERE username = '" . $_POST['username'] . "'";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($result);
    echo $row['count'];
}

function register(){
    global $connection;
    $query = "INSERT INTO user (name, surname, email, username, password, role, approvatedBy) VALUES ('" . $_POST['name'] . "', '" . $_POST['surname'] . "', '" . $_POST['email'] . "', '" . $_POST['username'] . "', '" . password_hash($_POST['password'], PASSWORD_DEFAULT) . "', '" . $_POST['role'] . "', '" . $_POST['referent'] . "')";
    if (mysqli_query($connection, $query)) {
        echo "Registrazione effettuata";
    } else {
        echo "Errore nella registrazione";
    }
}

function getPages(){
    global $connection;
    $query = "SELECT * FROM page";
    $result = mysqli_query($connection, $query);
    $output = "";
    $output .= '<div class="details"><div class="recentActivities"><div class="cardHeader"><h2>Pages</h2></div><table><thead><tr><td>Name</td><td>Category</td><td>User</td><td>Status</td></tr></thead><tbody>';
    while ($page = mysqli_fetch_array($result)){
        $output .= '<tr><td>' . $page['name'] . '</td></tr>';
    }
    $output .= '</tbody></table></div></div>';
    echo $output;
}