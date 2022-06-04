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
    $query = "SELECT user.idUser, user.name, user.surname FROM user INNER JOIN role ON user.role = role.idRole WHERE role.name = 'Administrator' AND user.approvated = 1";
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
        header('Location: /register.php?error=sqlError');
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sssssss", $name, $surname, $email, $uid, $hashedPwd, $role, $referent);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header('Location: /sections/registered.php');
    exit();
}

function loginUser($uid, $pwd){
    $userExists = usernameExists($uid, $uid);

    if($userExists === false){
        header('Location: /login.php?error=wrongLogin');
        exit();
    }

    $pwdHashed = $userExists['password'];

    $check = password_verify($pwd, $pwdHashed);

    if($check === false){
        header('Location: /login.php?error=wrongLogin');
        exit();
    } else if($userExists['approvated'] === 0){
        header('Location: /login.php?error=notApproved');
        exit();
    } else if($check === true){
        session_start();
        $_SESSION["id"] = $userExists['idUser'];
        $_SESSION["username"] = $userExists['username'];
        header('Location: /dashboard.php');
        exit();
    }
}

// DASHBOARD

function getUser($id){
    global $connection;
    $query = "SELECT * FROM user WHERE idUser = $id";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($result);
    return $row;
}

function getStatus($id){
    global $connection;
    $query = "SELECT * FROM status WHERE idStatus = $id";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($result);
    return $row;
}

function getPage($id){
    global $connection;
    $query = "SELECT * FROM page WHERE idPage = $id";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($result);
    return $row;
}

function getPages(){
    global $connection;
    $query = "SELECT * FROM page";
    $result = mysqli_query($connection, $query);
    $output = "";
    $output .= '<div class="details"><div class="recentActivities"><div class="cardHeader"><h2>Pages</h2><a href="sections/pageEditor.php" class="btn">New Page</a></div><table><thead><tr><td>Title</td><td>Author</td><td>Last Modify</td><td>Status</td><td>Actions</td></tr></thead><tbody>';
    while ($page = mysqli_fetch_array($result)){
        $author = getUser($page['createdBy']);
        $status = getStatus($page['status']); 
        $output .= '<tr><td>' . $page['name'] . '</td><td>' . $author['name'] . ' ' . $author['surname'] . '</td><td>' . $page['updatedAt'] . '</td><td><span class="status" style="background: ' . $status['color'] . '">' . $status['name'] . '</span></td><td><a><i class="fa-solid fa-trash"></i></a><a href="sections/pageEditor.php?id=' . $page['idPage'] . '"><i class="fa-solid fa-pencil"></i></a></td></tr>';
    }
    $output .= '</tbody></table></div></div>';
    echo $output;
}

function getProjects(){
    global $connection;
    $query = "SELECT * FROM project";
    $result = mysqli_query($connection, $query);
    $output = "";
    $output .= '<div class="details"><div class="recentActivities"><div class="cardHeader"><h2>Projects</h2><a href="sections/projectEditor.php" class="btn">New Project</a></div><table><thead><tr><td>Title</td><td>Author</td><td>Created At</td><td>Status</td><td>Actions</td></tr></thead><tbody>';
    while ($project = mysqli_fetch_array($result)){
        $author = getUser($project['createdBy']);
        $status = getStatus($project['status']); 
        $output .= '<tr><td>' . $project['name'] . '</td></tr>';
        $output .= '<tr><td>' . $project['name'] . '</td><td>' . $author['name'] . ' ' . $author['surname'] . '</td><td>' . $project['createdAt'] . '</td><td><span class="status" style="background: ' . $status['color'] . '">' . $status['name'] . '</span></td><td><button type="button"><i class="fa-solid fa-trash"></i></button><button type="button"><i class="fa-solid fa-pencil"></i></button></td></tr>';
    }
    $output .= '</tbody></table></div></div>';
    echo $output;
}

function getStatuses(){
    global $connection;
    $query = "SELECT * FROM status";
    return mysqli_query($connection, $query);
}

function savePage(){
    global $connection;
    session_start();
    $query = "INSERT INTO page (name, style, content, status, createdBy) VALUES ('" . $_POST['title'] . "', '" . $_POST['style'] . "', '" . $_POST['content'] . "', '" . $_POST['status'] . "', '" . $_SESSION['id'] . "')";
    $result = mysqli_query($connection, $query);
    if ($result) {
        echo "Page saved";
    } else {
        echo "Error";
    }
}

function updatePage(){
    global $connection;
    $id = $_POST['page'] ?? null;
    $title = $_POST['title'] ?? null;
    $style = $_POST['style'] ?? null;
    $content = $_POST['content'] ?? null;
    $status = $_POST['status'] ?? null;
    $query = "UPDATE page SET " . ($title !== null && $title !== '' ? "title = '" . $title . "', " : "") . ($style !== null && $style !== '' ? "style = '" . $style . "', " : "") . ($content !== null && $content !== '' ? "content = '" . $content . "', " : "") . ($status !== null && $status !== '' ? "status = " . $status . ", " : "") . " updatedAt = NOW() WHERE idPage = $id";
    $result = mysqli_query($connection, $query);
    if ($result) {
        echo "Page updated correctly";
    } else {
        echo "Error";
    }
}

function saveProject(){
    global $connection;
    session_start();
    $query = "INSERT INTO project (name, description, createdBy) VALUES ('" . $_POST['title'] . "', '" . $_POST['description'] . "', " . $_SESSION['id'] . ")";
    $result = mysqli_query($connection, $query);
    if ($result) {
        echo "Project saved";
    } else {
        echo "Error";
    }
}