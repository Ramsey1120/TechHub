<?php
require_once "include/header.php";
require_once "include/connect.php";

if (isset($id)) { ?>

    <div class="addPost">
        <a href="writePost.php" class="button">Write a post</a>
        <a href="include/deleteAllPost.php" class="button del">Delete All Posts</a>
    </div>

<?php } ?>

<?php

$author_name = $_GET["user"];

$all_my_post = "SELECT * FROM post WHERE post.userID LIKE (SELECT userID FROM user WHERE username='$author_name') ORDER BY date_posted DESC";
$all_my_post_result = mysqli_query($conn, $all_my_post) or die(mysqli_error($conn));

if (mysqli_num_rows($all_my_post_result) > 0) {
    while ($row = mysqli_fetch_array($all_my_post_result)) {

        echo "<h1 class='home-title'>" . $author_name . "'s posts</h1>";

        if (isset($id)) {
            echo "
            <div class='post'>
                <div class='postTitle'>" . ucfirst($row["title"]) . "</div>
                <div class='postContent'>" . ucfirst(substr($row["content"], 0, 250)) . 
                "...<a href='post.php?id=" . $row["postID"] . "'>Read More</a></div>
                <div class='date'>Uploaded the: " . substr($row["date_posted"], 0, 10) . "</div>
            </div>";

        } else {
            echo "
            <div class='post'>
                <div class='postTitle'>" . ucfirst($row["title"]) . "</div>
                <div class='postContent'>" . ucfirst(substr($row["content"], 0, 250)) . 
                "...<a href='post.php?id=" . $row["postID"] . "'>Read More</a></div>
                <div class='date'>Uploaded the: " . substr($row["date_posted"], 0, 10) . "</div>
                <a class='button postDel' href='include/deletePost.php?id=" . $row["postID"] . "'>Delete</a>
            </div>";
        }
        
        mysqli_close($conn);        
    }
} else { ?>
    <div class="post">
        <p class="postTitle">You have no posts!</p>
        <p style="text-align: center;">It seems like you have no posts. Click above to write one now.</p>
    </div>
<?php } ?>


<!-- CHANGE THIS OAGE UP COMPLETELY -->