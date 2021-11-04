<?php

require_once "connect.php";

session_start();

if (isset($_SESSION["id"])) {$username = $_SESSION["username"];}

$post_id = $_GET["id"];

$del_post = mysqli_query($conn, "DELETE FROM post WHERE postID = '$post_id'") or die(mysqli_query($conn));
mysqli_close($conn);

header("Location: ../userPosts.php?user=" . $username);

?>