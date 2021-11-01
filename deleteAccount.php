<?php

require_once "include/header.php";
require_once "inlcude/connect.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $delete_user = "DELETE FROM user WHERE userID = '$id'";
    $delete_user_result = mysqli_query($conn,$delete_user);

    session_destroy();
    header("Location: home.php");
} ?>


<form action="" method="post">
    <a href="profile.php"><img src="#" alt="#"> Back button</a>

    <legend>Delete Account</legend>

    <p class="del warning">Are you sure you want to delete your account</p>
    <p>THIS ACTION CANNNOT BE UNDONE</p>

    <input type="submit" value="Delete">
    
</form>

</body>
</html>