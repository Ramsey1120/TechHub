<?php 
require_once "include/header.php";
require_once "include/connect.php";
require_once "include/sanitise.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $e_mail = sanitise($_POST["email"]);
    $password = sanitise($_POST["password"]);
    
    $errors = [];

    $existing_email = mysqli_query($conn,"SELECT * FROM user WHERE email='$e_mail'") or die(mysqli_error($conn));

    if (mysqli_num_rows($existing_email) === 0) {
        $errors[] = "This e-mail does not exist. Try again.";
    } else {
        
        while ($row = mysqli_fetch_array($existing_email)) {

            if (!password_verify($password, $row["userpass"])) {
                $errors[] = "Invalid password. Try again.";
            } else {
                session_start();

                $_SESSION["id"] = $row["userID"];
                $_SESSION["username"] = $row["username"];
                $_SESSION["email"] = $row["email"];
                $_SESSION["signup_date"] = date('d f Y', strtotime($row["date_joined"]));

                header("Location: index.php");
                mysqli_close($conn);
            }
        }
    }
} ?> 

<form class="form auth" method="post">

    <legend class="legend">Welcome Back!</legend>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
            foreach ($errors as $error) {
                echo '<div class="error">' . $error . '</div>';
            }     
        }
    ?>
    
    <label for="email">E-mail</label>
    <input type="email" class="form-input" name="email" placeholder="Enter your e-mail" required><br>

    <label for="password">Password</label>
    <input type="password" class="form-input" name="password" placeholder="Enter password" required><br>

    <small>Don't have an account? <a href="signup.php">Sign up here</a></small>
    <input type="submit" value="Log In" class="button submit">
</form>

</body>
</html>

