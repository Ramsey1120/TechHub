<?php  
require_once "include/header.php";
require_once "include/connect.php";

$post_id = $_GET["id"];
$post = mysqli_query($conn, "SELECT * FROM post WHERE postID = '$post_id'") or die(mysqli_query($error));
$post_info = mysqli_fetch_array($post);

if (mysqli_num_rows($post) === 0) {
    
    echo "<div class='post'><h3 style='color:hsl(203,99%,40%);'>Post does not exist.</h3></div>";

} else {

    $title = ucfirst($post_info["title"]);
    $content = ucfirst($post_info["content"]);
    $date_posted = substr($post_info["date_posted"], 0, 10);
    $user_id = $post_info["userID"];

    $author_query = mysqli_query($conn, "SELECT username FROM user WHERE user.userID LIKE '$user_id'") or die(mysqli_query($error));
    $author = mysqli_fetch_array($author_query);


    if (isset($id)) {

        if ($id === $user_id) {

            echo "
            <div class='post fullPost'>
                <div class='postTitle'>" . $title . "</div>
                <a href='userProfile.php?user=" . $author["username"] . "' class='author'>Author: <b>" . $author["username"] . "</a></b>
                <div class='postContent'> " . $content . "</div>
                <a class='button postDel' href='include/deletePost.php?id=" . $post_id . "'>Delete</a>
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

}
          

mysqli_close($conn);
?>
</body>
</html>