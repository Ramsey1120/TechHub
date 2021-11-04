<?php

require_once "include/header.php";
require_once "include/connect.php";

$author_name = $_GET["user"];

$author = mysqli_query($conn,"SELECT userID FROM user WHERE username='$author_name'") 
or die(mysqli_error($conn));
$author_details = mysqli_fetch_array($author);
$author_id = $author_details["userID"];


$all_posts = mysqli_query($conn, "SELECT * FROM post WHERE post.userID = '$author_id' ORDER BY date_posted DESC") 
or die(mysqli_error($conn));

if (isset($id)) {

    if ($id === $author_id) {

        echo " <div class='addPost'>
        <a href='writePost.php' class='button'>Write a post</a>
        <a href='include/deleteAllposts.php' class='button del'>Delete All My Posts</a>
        </div>";

        echo "<h1 class='home-title'>My posts</h1>";

        if (mysqli_num_rows($all_posts) > 0) {

            while($row = mysqli_fetch_array($all_posts)) {

                echo 
                "<div class='post'>
                    <div class='postTitle'>" . ucfirst($row["title"]) . "</div>
                    <div class='postContent'>" . ucfirst(substr($row["content"], 0, 250)) . 
                    "...<a href='post.php?id=" . $row["postID"] . "'>Read More</a></div>
                    <a class='button postDel' href='include/deletePost.php?id=" . $row["postID"] . "'>Delete</a>
                    <div class='date'>Uploaded the: " . substr($row["date_posted"], 0, 10) . "</div>
                </div>";
            }   

        } else {

            echo  
            "<div class='post'>
                <p class='postTitle'>You have no posts!</p>
                <p style='text-align: center;'>It seems like you have no posts. Click above to write one now.</p>
            </div>";
        }
        

    } else {
        echo "<h1 class='home-title'>" . $author_name . "'s posts</h1>";

        while($row = mysqli_fetch_array($all_posts)) {

            echo "
            <div class='post'>
                <div class='postTitle'>" . ucfirst($row["title"]) . "</div>
                <div class='postContent'>" . ucfirst(substr($row["content"], 0, 250)) . 
                "...<a href='post.php?id=" . $row["postID"] . "'>Read More</a></div>
                <div class='date'>Uploaded the: <b>" . substr($row["date_posted"], 0, 10) . "</b</div>
            </div>";
        }
    }         

} else {

    if (mysqli_num_rows($all_posts) > 0) {

        echo "<h1 class='home-title'>" . $author_name . "'s posts</h1>";

        while($row = mysqli_fetch_array($all_posts)) {
            echo "
            <div class='post'>
                <div class='postTitle'>" . ucfirst($row["title"]) . "</div>
                <div class='postContent'>" . ucfirst(substr($row["content"], 0, 250)) . 
                "...<a href='post.php?id=" . $row["postID"] . "'>Read More</a></div>
                <div class='date'>Uploaded the: <b>" . substr($row["date_posted"], 0, 10) . "</b</div>
            </div>";
        }

    } else {

        echo  
            "<div class='post'>
                <p class='postTitle'>" . $author_name . " has no posts!</p>
                <p style='text-align: center;'>It seems like they has no posts. :-(</p>
            </div>";
    }

}

mysqli_close($conn);        

?>