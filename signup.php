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

    $existing_email = "SELECT * FROM user WHERE email='$email'";
    $existing_email_result = mysqli_query($conn,$existing_email) or die(mysqli_error($conn));

    if (strlen($username) < 3 or strlen($username) > 35) {
        $errors[] = "Username must be between 3 and 35 characters long";
    }

    if (strlen($e_mail) < 8 or strlen($email) > 100) {
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
        $register = "INSER INTO user(username,email,userpass) VALUES('$username','$e_mail','$password')";
        $register_result = mysqli_query($conn,$register) or die(mysqli_error($conn));
        header("Location: login.php");
    }
    
    mysqli_close($conn);
}

?>

<form action="" method="post">
    <legend class="form-legend">Join us Today!</legend>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            foreach ($errors as $errror) {
                echo '<div class="error">' . $error . '</div>';
            }     
        }
    ?>
    <input type="username" class="form-input" name="username" placeholder="Enter your username"><br>
    <input type="email" class="form-input" name="email" placeholder="Enter your e-mail" required><br>
    <input type="password" class="form-input" name="password" placeholder="Enter password" required><br>
    <input type="password" class="form-input" name="confirmation" placeholder="Enter password confirmation" required><br>
    <small>Already have an account? <a href="login.php">Sign up here</a></small>
    <input type="submit" value="Sign up" class="button submit">
</form>
</body>
</html>