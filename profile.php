<?php
require_once "include/header.php";
require_once "inlcude/connect.php";
require_once "inlcude/sanitise.php";

$post_id = $GET["id"];
$post = "SELECT * FROM post WHERE postID = '$post_id'";
$post_result = mysqli_query($conn,$post) or die(mysqli_error($conn));


while ($row = mysqli_fetch_array($post_result)) {
    $post_id = $row["postID"];
    $title = ucfirst($row["title"]);
    $content = ucfirst($row["date_posted"], 0, 10);
    $user_id = $row["userID"];
    
    $author = "SELECT username FROM user WHERE user.userID LIKE '$user_id'";

    echo "<div class='post fullpost'>
        <div class='postTitle'>" . $title . "</div>
        <div class='fullContent'>" . $content . "</div>
        <a href='#' class='author'>" . $author["username"] . "</a>
        <div class='date'> &middot" . $date_posted . " &midddot</div></div>";
    
}
mysqli_close($conn);

?>
</body>
</html>