<!--  building the profile page of instagram for the user to see their information and edit it if they want to  -->
<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('location:../index.php');
}

if (isset($_GET['username'])) {
    $username = $_GET['username'];
    include('db_connection.php');
    $sql1 = "SELECT * FROM users WHERE username='$username' LIMIT 1";

    $result1 = mysqli_query($db_connection, $sql1);
    if (mysqli_num_rows($result1) > 0) {
        if ($user_data = mysqli_fetch_assoc($result1)) {
            $user_profile_pic = $user_data['profile_pic'];
            $user_id = $user_data['id'];
            $user_fullname = $user_data['fullname'];
        }
    }
} else {
    header('location:home.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile @<?php echo $username; ?></title>
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="../css/profile.css">
    <link rel="stylesheet" href="../css/home.css">
    <style>

    </style>
</head>

<body>
    <main>
        <main>
        <?php include 'sidebar.php'; ?>
            <div class="profile_section">
                <div class="profile_centent">
                    <div class="profile_header">
                        <div class="profile_image">
                            <img src="<?php echo "../Database/images/" . $user_profile_pic ?>" alt="user profile pic">
                        </div>
                        <div class="user_profile_info">
                            <div class="user_profile_name">
                                <h1><?php echo $username; ?></h1>
                            </div>
                            <ul class="user_profile_details">
                                <li class="profile_posts"> 1 Posts </li>
                                <li class="user_followers"> 100 Followers </li>
                                <li class="user_following"> 10 Following </li>
                            </ul>
                            <div class="user_profile_bio">
                                <h3><?php echo $user_fullname; ?></h3>
                                <p>Turned my dreams into my vision and my vision into my reality.</p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h3 class="post_headline">Posts</h3>
                    <div class="post-section">
                        <div class="post">
                            <?php

                            $sql = "SELECT * FROM posts WHERE user_id='$user_id' ORDER BY id DESC";
                            $result = mysqli_query($db_connection, $sql);

                            if (mysqli_num_rows($result) > 0)  // if there are posts in database
                            {
                                while ($post_data = mysqli_fetch_assoc($result)) {
                                    $post_id = $post_data['id'];

                            ?>

                                    <div class="post-header">
                                        <div class="post-header-img">
                                            <img src="<?php echo "../Database/images/" . $user_profile_pic ?>" alt="user profile pic">
                                        </div>
                                        <div class="post-header-name">
                                            <a href="profile.php?username=<?php echo $username; ?>"><?php echo $username; ?></a>
                                        </div>
                                        <div class="post-header-3dot">
                                            <img src="../src/images/More.png" alt="3dot">
                                        </div>
                                    </div>
                                    <?php
                                    if (!empty($post_data['image'])) {
                                    ?>
                                        <div class="post-img">
                                            <img src="<?php echo "../Database/images/" . $post_data['image'] ?>" alt="user post pic">
                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <div class="post-video">
                                            <video controls loop muted>
                                                <source src="<?php echo "../Database/videos/" . $post_data['video'] ?>" type="video/mp4">
                                            </video>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                    <div class="post-footer">
                                        <div class="post-footer-icons">
                                            <img src="../src/images/like.png" alt="like">
                                            <img src="../src/images/comment.png" alt="comment">
                                            <img src="../src/images/share.png" alt="share">
                                        </div>
                                        <div class="post-footer-likes">
                                            <span>100 likes</span>
                                        </div>
                                        <div class="post-footer-caption">
                                            <span><?php echo $post_data['caption']; ?></span>
                                        </div>
                                        <div class="post-footer-time">
                                            <!--  take date from database and convert it into time ago -->
                                            <?php
                                            $time_ago = $post_data['date'];
                                            include('time_ago.php');
                                            ?>
                                        </div>
                                        <div class="post-footer-comments">
                                            <span>View all 100 comments</span>
                                        </div>
                                        <div class="post-footer-add-comment">
                                            <input type="text" placeholder="Add a comment...">
                                            <button>Post</button>
                                        </div>
                                    </div>
                                    <hr>

                            <?php
                                }
                            } else {
                                echo "No posts yet";
                            }
                            ?>
                        </div>
                    </div>
                </div>
        </main>
</body>

</html>