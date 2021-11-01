<?php
require_once "connect.php";

session_start();

$post_id = $_GET["id"];

$del_post = "DELETE FROM post WHERE postID = '$post_id'";
$del_post_result = mysqli_query($conn, $del_post) or die(mysqli_query($conn));
mysqli_close($conn);

header("Location: ../userPosts.php");

?>