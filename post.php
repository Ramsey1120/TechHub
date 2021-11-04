<?php  
require_once "include/header.php";
require_once "include/connect.php";

$post_id = $_GET["id"];
$post = mysqli_query($conn, "SELECT * FROM post WHERE postID = '$post_id'") or die(mysqli_query($error));
$post_info = mysqli_fetch_array($post);

$post_id = $row["postID"];
$title = ucfirst($row["title"]);
$content = ucfirst($row["content"]);
$date_posted = substr($row["date_posted"], 0, 10);
$user_id = $row["userID"];

$author_query = mysqli_query($conn, "SELECT username FROM user WHERE user.userID LIKE '$user_id'") or die(mysqli_query($error));
$author = mysqli_fetch_array($author_query);


if (isset($id)) {

    if ($id === $user_id) {

        echo "
        <div class='post fullPost'>
            <div class='postTitle'>" . $title . "</div>
            <a href='userProfile.php?user=" . $author["username"] . "' class='author'>Author: <b>" . $author["username"] . "</a></b>
            <div class='postContent'> " . $content . "</div>
            <a class='button postDel' href='include/deletePost.php?id=" . $all_posts_result["postID"] . "'>Delete</a>
        <div class='date'>Uploaded the: <b>" . $date_posted . "</b></div></div>";   

    } else {
        echo "<div class='post fullPost'>
    <div class='postTitle'>" . $title . "</div>
    <a href='userProfile.php?user=" . $author["username"] . "' class='author'>Author: <b>" . $author["username"] . "</a></b>
            <div class='postContent'> " . $content . "</div>
            <div class='date'>Uploaded the: <b>" . $date_posted . "</b></div></div>";   
    }

} else {
    echo "<div class='post fullPost'>
    <div class='postTitle'>" . $title . "</div>
    <a href='userProfile.php?user=" . $author["username"] . "' class='author'>Author: <b>" . $author["username"] . "</a></b>
            <div class='postContent'> " . $content . "</div>
            <div class='date'>Uploaded the: <b>" . $date_posted . "</b></div></div>";   
}
             

mysqli_close($conn);
?>
</body>
</html>