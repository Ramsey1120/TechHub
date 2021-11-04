<?php
    require_once "connect.php";

    session_start();
    if (isset($_SESSION["id"])) { $id = $_SESSION["id"]; }

    $del_post_result = mysqli_query($conn, "DELETE FROM post WHERE userID = '$id'") or die(mysqli_query($conn));
    mysqli_close($conn);

    header("Location: ../index.php");
?>