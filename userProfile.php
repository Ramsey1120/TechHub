<?php
require_once "include/header.php";
require_once "include/connect.php";
require_once "include/sanitise.php";

$author_name = $_GET["user"];

$user_details = mysqli_query($conn,"SELECT userID,username,email,date_joined FROM user WHERE user.username='$author_name'") 
or die(mysqli_error($conn));
$user = mysqli_fetch_array($user_details);

$user_id = $user["userID"];

$post_count = mysqli_query($conn,"SELECT COUNT(userID) AS Num FROM post WHERE post.userID='$user_id'") 
or die(mysqli_error($conn));
$all_posts = mysqli_fetch_array($post_count);


?>

<form method="post" class="form profile">

    <legend class="legend"><?php echo $user["username"] ?></legend>

    Username <input type="text" class="form-input" placeholder="<?php echo $user["username"] ?>" disabled><br>

    E-mail <input type="email" class="form-input" placeholder="<?php echo $user["email"] ?>" disabled><br>

    <p>Number of posts written: <b><?php echo $all_posts["Num"]  ?> </b></p>

    <p>Joined Date: <b><?php echo date('d F Y', strtotime($user["date_joined"])) ?></b></p>

    <?php  
        if (isset($id)) {

            if ($id === $user_id) {

                echo "<a href='updateProfile.php' class='button viewPosts'>Update your details</a>";
                echo "<a href='userPosts.php?user=" . $author_name ."' class='button viewPosts'> View all my posts</a>";
                echo "<hr>";
                echo "<a href='include/deleteAllposts.php' class='button viewPosts del'>Delete all my posts</a>";
                echo "<a href='deleteAccount.php' class='button viewPosts del'> Delete my account</a>";

            } else {
                echo "<a href='userPosts.php?user=" . $author_name ."' class='button viewPosts'> View all " . $user["username"] . "'s posts</a>";
            }
        }
         else {
            echo "<a href='userPosts.php?user=" . $author_name ."' class='button viewPosts'> View all " . $user["username"] . "'s posts</a>";
        }
    ?>

</form>
</body>
</html>