<?php
require_once "include/header.php";
require_once "inlcude/connect.php";
require_once "inlcude/sanitise.php";
phpinfo();
$author_id = $GET["user"];

$posts_no = "SELECT COUNT(userID) AS Num FROM post WHERE post.userID='$author_id'";
$post_no_result = mysqli_query($conn,$posts_no) or die(mysqli_error($conn));
$all_posts = mysqli_fetch_array($post_no_result);

$user_details = "SELECT username,email,date_joined FROM user WHERE user.userID='$author_id'";
$user_details_result = mysqli_query($conn,$user_details);
$user = mysqli_fetch_array($user_details_result);

?>

<form action="" method="post" class="profile">
    <legend><?php echo $user["username"] ?></legend>

    Username <input type="text" class="form-input" placeholde="<?php echo $user["username"] ?>" disabled><br>

    E-mail <input type="email" class="form-input" placeholder="<?php echo $user["email"] ?>" disabled><br>

    Number of posts written: <?php echo $all_posts["Num"]  ?> <br>

    Joined Date: <?php echo date('d F Y', strtotime($user["date_joined"])) ?>

    <input type="submit" value="hello">
</form>
</body>
</html>