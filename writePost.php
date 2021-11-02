<?php

require_once "include/header.php";
require_once "include/connect.php";
require_once "include/sanitise.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];

    $title = sanitise($_POST["title"]);
    $content = sanitise($_POST["content"]);

    if (strlen($title) < 3 or strlen($title) > 100) {$errors[] = "Title must be between 3 and 100 characters long";}

    if (strlen($content) < 5 or strlen($content) > 2500) {$errors[] = "Your post must be between 5 and 25000 characters long";}

    if (empty($errors)) {
    $now = date("Y-m-d H:i:s");
        $insert_post = "INSERT INTO post (title,content,userID,date_posted) VALUES ('$title','$content','$id','$now')";
        $insert_post_result = mysqli_query($conn,$insert_post) or die(mysqli_error($conn));

        header("Location: index.php");
        mysqli_close($conn);
    }
}

?>

<form class="form writePost" method="post">

    <legend class="legend">Write a Post</legend>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            foreach ($errors as $error) {
                echo '<div class="error">' . $error . '</div>';
            }     
        }
    ?>

    <label for="title">Title</label>
    <input type="text" class="form-input" name="title" placeholder="Enter a title"><br>

    <textarea name="content" class="form-input" cols="40" rows="10" placeholder="Write your post here (max 2500 Characters)"></textarea>
    <br><input type="submit" value="Upload" class="button submit">
</form>
</body>
</html>