<?php 
require_once "include/header.php";
require_once "include/connect.php";
require_once "include/sanitise.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = sanitise($_POST["username"]);
    $e_mail = sanitise($_POST["email"]);
    $password = sanitise($_POST["password"]);
    $confirmation = sanitise($_POST["confirmation"]);

    $errors = [];

    $existing_email = "SELECT * FROM user WHERE email='$e_mail'";
    $existing_email_result = mysqli_query($conn,$existing_email) or die(mysqli_error($conn));

    if (strlen($username) < 3 or strlen($username) > 35) {
        $errors[] = "Username must be between 3 and 35 characters long";
    }

    if (strlen($e_mail) < 8 or strlen($e_mail) > 100) {
        $errors[] = "Email must be between 8 and 100 characters long";
    }

    if (mysqli_num_rows($existing_email_result) > 0) {
        $errors[] = "Email already taken. Try again.";
    }

    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long.";
    }
    
    if (!($password === $confirmation)) {
        $errors[] = "Password and password confirmation do not match.";
    }


    if (empty($errors)) {
        $password = password_hash($password, PASSWORD_BCRYPT);
        $now = date("Y-m-d H:i:s");
        $register = "INSERT INTO user(username,email,userpass,date_joined) VALUES('$username','$e_mail','$password','$now')";
        $register_result = mysqli_query($conn,$register) or die(mysqli_error($conn));
        header("Location: login.php");
    }
    
    mysqli_close($conn);
}

?>

<form class="form auth"action="" method="post">

    <legend class="legend">Join us Today!</legend>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            foreach ($errors as $error) {
                echo '<div class="error">' . $error . '</div>';
            }     
        }
    ?>
    <label for="username">Username</label>
    <input type="username" class="form-input" name="username" placeholder="Enter your username"><br>

    <label for="email">E-mail</label>
    <input type="email" class="form-input" name="email" placeholder="Enter your e-mail" required><br>

    <label for="password">Password</label>
    <input type="password" class="form-input" name="password" placeholder="Enter password" required><br>

    <label for="confirmation">Password confirmation</label>
    <input type="password" class="form-input" name="confirmation" placeholder="Enter password confirmation" required><br>
    
    <small>Already have an account? <a href="login.php">Log In here</a></small>
    <input type="submit" value="Sign up" class="button submit">
</form>
</body>
</html>