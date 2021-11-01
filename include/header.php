<?php

session_start();

if (isset($_SESSION["id"])) {
    $id = $_SESSION["id"];
    $username = $_SESSION["username"];
    $email = $_SESSION["email"];
    $signup_date = $_SESSION["signup_date"];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Write posts/blogs about technology">
    <meta name="keywords" content="Tech articles, Tech Blog, Tech News, Tech Posts">
    <title>TechHub.com</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <nav>
        <a href="..\index.php">Home</a>
        <a href="..\signup.php">Sign Up</a>
        <?php if (isset($_SESSION["id"])) { ?>
            <a href="..\profile.php">My Profile</a>
            <a href="logout.php">Log Out</a>
        <?php } else { ?>
            <a href="..\login.php">Login</a>
        <?php } ?>
    </nav>
    
