<?php 

require_once "include/header.php"; 
require_once "include/connect.php";

if (isset($id)) {echo "<a class='button addPost' href='writePost.php'>Write a post</a>";}

$posts_query = mysqli_query($conn, "SELECT * FROM post ORDER BY date_posted DESC") or die(mysqli_error($conn));

echo "<h1 class='home-title'>TechHub Home</h1>";

while ($row = mysqli_fetch_array($posts_query)) {
    $post_id = $row["postID"];
    $title  = ucfirst($row["title"]);
    $content = ucfirst(substr($row["content"],0,250));
    $date_posted = substr($row["date_posted"],0,10);
    $user_id = $row["userID"];
    
    $post_author_query = mysqli_query($conn,"SELECT username FROM user WHERE userID='$user_id'");
    $author = mysqli_fetch_array($post_author_query);

    echo "<article class='post'> 
    <p class='postTitle'>" . $title . "</p>" .
    "<a href='userProfile.php?user=" . $author["username"] . "' class='author'>Author: <b>" . $author["username"] ."</b></a>" .
    "<div class='postContent'>" . $content . "...<a href='post.php?id=" . $post_id . "'> Read More</a></div>" . 
    "<div class='date'>Uploaded the: <b>" . $date_posted . "</b></div></article>"; 
    
}

mysqli_close($conn);
?>


<aside class="aside">
    <legend class="legend">Welcome to TechHub!</legend>
    <p>Welcome to TechHub where you can share your tech knowledge witht the world!</p>
</aside>

</body>
</html>

