<?php  

require_once "include/header.php";
require_once "include/connect.php";
require_once "inlcude/sanitise.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = sanitise($_POST["username"]);
    $e_mail = sanitise($_POST["e-mail"]);
    $username = sanitise($_POST["password"]);
    $confirmation = sanitise($_POST["confirmation"]);

    $email_check = "SELECT * FROM user WHERE email= '$e_mail' AND email <> '$email'";
    $email_check_result = mysqli_query($conn,$email_check) or die(mysqli_error($conn));

    $user_check = "SELECT * FROM user WHERE username= '$username' AND email <> '$name'";
    $user_check_result = mysqli_query($conn,$user_check) or die(mysqli_error($conn));

    $password_check = "SELECT userpass FROM user WHERE userID = '$id'";
    $password_check_result = mysqli_query($conn,$password_check) or die(mysqli_error($conn));
    $user_password = mysqli_fetch_array($password_check_result);

    $errors = [];


    if (strlen($username) < 3 or strlen($username) > 35) {
        $errors[] = "New username must be between 3 and 35 characters long.";
    }

    if (strlen($e_mail) < 8 or strlen($email) > 100) {
        $errors[] = "New e-mail must be between 8 and 100 characters long.";
    }

    if (mysqli_num_rows($existing_email_result) > 0) {
        $errors[] = "Email already taken. Try again.";
    }
    
    
    if (!password_verify($password,$user_password["userpass"])) {
        $errors[] = "Invald password. Try again.";
    } else {

        if (!($password === $confirmation)) {
            $errors[] = "Password and password confirmation do not match.";
        }
    }

    if (empty($errors)) {
        $password = password_hash($password, PASSWORD_BCRYPT);
        $udpate = "UPDATE user SET username ='$username', email = '$e_mail' WHERE userID = '$id'";
        $udpate_result = mysqli_query($conn,$udpate) or die(mysqli_error($conn));
        session_destroy();
        header("Location: login.php");
    }
    mysqli_close($conn);
}

?>


<form action="" method="post">
    <legend class="form-legend">Join us Today!</legend>
    <?php
        if ($_SERVER["REQUEST_METHOD"]) {
            foreach ($errors as $errror) {
                echo '<div class="error">' . $error . '</div>';
            }     
        }
    ?>
    <input type="username" class="form-input" name="username" placeholder="Enter your new username" value="<?php echo $name ?>" required><br>
    <input type="email" class="form-input" name="email" placeholder="Enter your new e-mail"  value="<?php echo $emai ?>" required><br>
    <input type="password" class="form-input" name="password" placeholder="Enter password" required><br>
    <input type="password" class="form-input" name="confirmation" placeholder="Enter password confirmation" required><br>
    <small>Already have an account? <a href="login.php">Sign up here</a></small>
    <input type="submit" value="Sign up" class="button submit">
</form>
</body> 
</html>