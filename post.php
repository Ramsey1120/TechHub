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
    $author_result = mysqli_fetch_array($author_result);

    echo "<div class='post'><div class='postTitle'>" . $title . "</div>
            <div class='postCotent'> " . $content . "</div>
            <a href='#' class='author'> " . $author["username"] . " <a/>
            <div class='date'> &middot" . $date_posted . " &middot</div></div>";            
}

mysqli_close($conn);
?>
</body>
</html>