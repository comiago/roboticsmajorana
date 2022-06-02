<?php require('sections/header.php'); ?>

<div class="admin">
    <div class="login">
        <h1>Login</h1>
        <form action = "dbh/login.inc.php" method="POST">
            <div class="txtField">
                <input type="text" name = "username" required>
                <span></span>
                <label>Username</label>
            </div>
            <div class="txtField">
                <input type="password" name = "password" required>
                <span></span>
                <label>Password</label>
            </div>
            <div class="pass">Forgot password?</div>
            <input type="submit" name="submit" value="Login">
            <div class="signUp">
                Not a member? <a href="/register.php">Register</a>
            </div>
        </form>
    </div>
</div>

<?php
$error = $_GET['error'] ?? null;
if($error == 'wrongLogin'){
    echo "<script>alert('Incorrect login informations!')</script>";
}

require('sections/footer.php');
?>