<?php require('sections/header.php'); ?>

<div class="register">
    <h1>Register</h1>
    <form class="form">
        <div class="txtField">
            <input type="text" id="name" required>
            <span></span>
            <label>Name</label>
        </div>
        <div class="txtField">
            <input type="text" id="surname" required>
            <span></span>
            <label>Surname</label>
        </div>
        <div class="txtField">
            <input type="email" id="email" required>
            <span></span>
            <label>Email</label>
        </div>
        <div class="txtField">
            <input type="text" id="username" required>
            <span></span>
            <label>Username</label>
        </div>
        <div class="txtField">
            <input type="password" id="password" required>
            <span></span>
            <label>Password</label>
        </div>
        <div class="txtField">
            <input type="password" id="confirmPassword" required>
            <span></span>
            <label>Confirm Password</label>
        </div>
        <div class="txtField">
            <select id="role" required>
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
            <select id="referent" required>
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
        <input type="submit" value="Register">
        <div class="signUp">
            Already registered? <a href="login.php">Login</a>
        </div>
    </form>
</div>

<?php require('sections/footer.php'); ?>