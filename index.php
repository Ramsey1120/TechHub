<?php 

require_once "include/header.php"; 
require_once "include/connect.php";

if (isset($id)) {
    echo "<div class='addPost'><a class='button' href='writePost.php'>Write a post</a></div>";
} else {
    echo "<div class='addPost'><a class='button' href='signup.php'>Join us today</a></div>";
}

$all_posts = "SELECT * FROM post ORDER BY date_posted DESC";
$all_posts_result = mysqli_query($conn, $all_posts) or die(mysqli_error($conn));


while ($row = mysqli_fetch_array($all_posts_result)) {
    $post_id = $row["postID"];
    $title  = ucfirst($row["title"]);
    $content = ucfirst(substr($row["content"],0,275));
    $date_posted = substr($row["date_posted"],10);
    $user_id = $row["userID"];

    
    $post_author = "SELECT username FROM user WHERE userID='$user_id'";
    $post_author_result = mysqli_query($conn,$post_author);
    $author = mysqli_fetch_array($post_author_result);

    if (strlen($content) > 100) {
        echo "<article class='post'> 
        <p class='postTitle'>" . $title . "</p>" .
        "<p class='postContent'>" . $content . "...<a href='post.php?id=" . $post_id . "'> Read More</a>" . 
        "<div class='date'>" . $date_posted . "</div> 
        <a href='userProfile.php?user'" . $user_id . "' class='author'>" . $author["username"] ."</a></article>";
    } else {
        echo "<article class='post'> 
        <p class='postTitle'>" . $title . "</p>" .
        "<p class='postContent'>" . $content . "...<a href='post.php?id=" . $post_id . "'> Read More</a>" . 
        "<div class='date'>" . $date_posted . "</div> 
        <a href='userProfile.php?user'" . $user_id . "' class='author'>" . $author["username"] ."</a></article>";
    }
}

mysqli_close($conn);
?>

</body>
</html>

