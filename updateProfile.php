<?php  

require_once "include/header.php";
require_once "include/connect.php";
require_once "include/sanitise.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $old_username = sanitise($_POST["username"]);
    $e_mail = sanitise($_POST["email"]);
    $password = sanitise($_POST["password"]);
    $confirmation = sanitise($_POST["confirmation"]);

    $email_check = "SELECT * FROM user WHERE email= '$e_mail' AND email <> '$email'";
    $email_check_result = mysqli_query($conn,$email_check) or die(mysqli_error($conn));

    $user_check = "SELECT * FROM user WHERE username= '$old_username' AND email <> '$username'";
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

    if (mysqli_num_rows($email_check_result) > 0) {
        $errors[] = "Email already taken. Try again.";
    }

    if (mysqli_num_rows($user_check_result) > 0) {
        $errors[] = "Username already taken. Try again.";
    }
    
    if (!password_verify($password,$user_password["userpass"])) {
        $errors[] = "Invalid password. Try again.";
    } else {

        if (!($password === $confirmation)) {
            $errors[] = "Password and password confirmation do not match.";
        }
    }

    if (empty($errors)) {
        $udpate = "UPDATE user SET username ='$username', email = '$e_mail' WHERE userID = '$id'";
        $udpate_result = mysqli_query($conn,$udpate) or die(mysqli_error($conn));
        session_destroy();
        header("Location: login.php");
    }
    mysqli_close($conn);
} ?>

<form class="form profile" method="post">

    <legend class="legend">Update your profile</legend>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            foreach ($errors as $error) {
                echo '<div class="error">' . $error . '</div>';
            }     
        }
    ?>

    <label for="username">New username:</label>
    <input type="username" class="form-input" name="username" placeholder="Enter your new username" value="<?php echo $username ?>" required><br>

    <label for="email">New e-mail:</label>
    <input type="email" class="form-input" name="email" placeholder="Enter your new e-mail"  value="<?php echo $email ?>" required><br>

    <label for="password">Enter your password:</label>
    <input type="password" class="form-input" name="password" placeholder="Enter password" required><br>

    <label for="confirmation">Enter password confirmation:</label>
    <input type="password" class="form-input" name="confirmation" placeholder="Enter password confirmation" required><br>
    
    <input type="submit" value="Sign up" class="button submit">
</form>
</body> 
</html>