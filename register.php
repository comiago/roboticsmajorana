<?php require('sections/header.php'); ?>

<div class="register">
    <h1>Register</h1>
    <form class="form" action="dbh/register.inc.php" method="post">
        <div class="txtField">
            <input type="text" id="name" name="name" required>
            <span></span>
            <label>Name</label>
        </div>
        <div class="txtField">
            <input type="text" id="surname" name="surname" required>
            <span></span>
            <label>Surname</label>
        </div>
        <div class="txtField">
            <input type="email" id="email" name="email" required>
            <span></span>
            <label>Email</label>
        </div>
        <div class="txtField">
            <input type="text" id="username" name="username" required>
            <span></span>
            <label>Username</label>
        </div>
        <div class="txtField">
            <input type="password" id="password" name="password" required>
            <span></span>
            <label>Password</label>
        </div>
        <div class="txtField">
            <input type="password" id="confirmPassword" name="confirmPassword" required>
            <span></span>
            <label>Confirm Password</label>
        </div>
        <div class="txtField">
            <select id="role" name="role" required>
                <option value="">--Role</option>
                <?php
                    require('dbh/administration.php');
                    $roles = getRoles();
                    while($role = mysqli_fetch_array($roles)){
                        echo '<option value="' . $role["idRole"] . '">' . $role["name"] . '</option>';;
                    }
                ?>
            </select>
            <span></span>
        </div>
        <div class="txtField">
            <select id="referent" name="referent" required>
                <option value="">--Referent</option>
                <?php
                    $referents = getReferents();
                    while($referent = mysqli_fetch_array($referents)){
                        echo '<option value="' . $referent["idUser"] . '">' . $referent["name"] . ' ' . $referent["surname"] . '</option>';;
                    }
                ?>
            </select>
            <span></span>
        </div>
        <input type="submit" name="submit" value="Register">
        <div class="signUp">
            Already registered? <a href="/login.php">Login</a>
        </div>
    </form>
</div>

<?php

$error = $_GET['error'] ?? null;
if($error){
    echo "<script>alert('";
    switch ($error) {
        case 'invalidUsername':
            echo "Invalid Username!";
            break;
        case 'invalidEmail':
            echo "Invalid Email!";
            break;
        case 'passwordDontMatch':
            echo "Passwords don't match!";
            break;
        case 'usernameExists':
            echo "Username or Email already exists!";
            break;
        case 'sqlError':
            echo "Something goes wrong!";
            break;
    }
    echo "')</script>";
}

require('sections/footer.php');
?>