<?php require('sections/header.php'); ?>
<!-- 
<style>
    body{
        height: 100vh;
        overflow: hidden; 
    }
</style> -->

<div class="admin">
    <div class="login">
        <h1>Login</h1>
        <form method="POST">
            <div class="txtField">
                <input type="text" required>
                <span></span>
                <label>Username</label>
            </div>
            <div class="txtField">
                <input type="password" required>
                <span></span>
                <label>Password</label>
            </div>
            <div class="pass">Forgot password?</div>
            <input type="submit" value="Login">
            <div class="signUp">
                Not a member? <a href="register.php">Register</a>
            </div>
        </form>
    </div>
</div>

<?php require('sections/footer.php'); ?>