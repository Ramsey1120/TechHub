<?php

require_once "include/header.php";
require_once "include/connect.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $delete_user = "DELETE FROM user WHERE userID = '$id'";
    $delete_user_result = mysqli_query($conn,$delete_user);

    session_destroy();
    header("Location: index.php");
} ?>


<form class="form delete" method="post">

    <legend class="legend">Delete Account</legend>

    <p class="del-warning">Are you sure you want to delete your account? This action will delete all your posts.
    <br>THIS ACTION CANNNOT BE UNDONE!</p>

    <input class="button submit del" type="submit" value="Delete">
    
</form>

</body>
</html>