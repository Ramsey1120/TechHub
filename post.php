<?php  
require_once "include/header.php";
require_once "include/connect.php";

$post_id = $_GET["id"];
$post = "SELECT * FROM post WHERE postID = '$post_id'";
$post_result = mysqli_query($conn, $post) or die(mysqli_query($error));

while ($row = mysqli_fetch_array($post_result)) {
    $post_id = $row["postID"];
    $title = ucfirst($row["title"]);
    $content = ucfirst($row["content"]);
    $date_posted = substr($row["date_posted"], 0, 10);
    $user_id = $row["userID"];

    $author = "SELECT username FROM user WHERE user.userID LIKE '$user_id'";
    $author_result = mysqli_query($conn, $author) or die(mysqli_query($error));
    $post_author = mysqli_fetch_array($author_result);

    echo "<div class='post fullPost'>
    <div class='postTitle'>" . $title . "</div>
    <a href='userProfile.php?user=" . $post_author["username"] . "' class='author'>Author: <b>" . $post_author["username"] . "</a></b>
            <div class='postContent'> " . $content . "</div>
            <div class='date'>Uploaded the: <b>" . $date_posted . "</b></div></div>";            
}

mysqli_close($conn);
?>
</body>
</html>