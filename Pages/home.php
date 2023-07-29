<?php
session_start();
if (!isset($_SESSION['id'])) {
    echo "<script>alert('Please Login to continue!')</script>";
    header('location:../index.php');
}

?>

<!-- building home page of instagram website -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Instagram</title>
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="../css/home.css">
    <link rel="stylesheet" href="../css/profile.css">
    <style>
        .right-sidebar-suggestions {
            width: 100%;
            border-bottom: 1px solid #dbdbdb;

        }

        .right-sidebar-suggestions-header {
            padding: 10px 15px;
        }

        .right-sidebar-suggestions-body {
            display: flex;
            align-items: left;
            padding: 10px 15px;
            padding-left: 0px;
        }

        .right-sidebar-suggestions-body-img img {
            width: 32px;
            height: 32px;
            border-radius: 50%;
        }

        .right-sidebar-suggestions-body-name {
            margin-left: 10px;
        }

        .right-sidebar-suggestions-body-name a {
            font-weight: 600;
            font-size: 14px;
            color: #262626;
            text-decoration: none;
        }

        .right-sidebar-suggestions-body-name span {
            display: block;
            font-size: 12px;
            
        }

        .following{
            color: #8e8e8e;
        }

        .right-sidebar-suggestions-body-follow {
            margin-left: auto;

        }

        .follow-btn {
            color: #0095f6;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
        }

        #see_all{
            color: #0095f6;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
        }

        .right-sidebar-footer {
            padding: 10px 15px;
            font-size: 12px;
            color: #8e8e8e;
        }

        .right-sidebar-footer span {
            margin-right: 10px;
        }

        .post-footer-icons{
            display: flex;
            align-items: center;
            justify-content: space-between;
            /* padding: 10px 15px; */
        }

        .post-footer-icons-left img{
            margin-right: 10px;
        }

        .post-footer-icons-right img{
            margin-right: 10px;
        }

        .post-footer-likes{
            font-size: 14px;
            font-weight: 600;
        }

        .post-footer-caption a{
            font-weight: 600;
            font-size: 14px;
            color: #262626;
            text-decoration: none;
        }

        .post-footer-time{
            font-size: 15px;
            color: #8e8e8e;
        }

        .post-footer-icons-left{
            display: flex;
        }

    </style>
</head>

<body>
    <main>
        <?php include 'sidebar.php'; ?>
        <div class="main-content">
            <div class="content">
                <div class="post-section">
                    <!-- displaying random posts of different users that may include pic or videos taken from database named instagram -->
                    <div class="post">
                        <?php
                        include('db_connection.php');
                        $sql = "SELECT * FROM posts ORDER BY RAND()"; // LIMIT 85";
                        $result = mysqli_query($db_connection, $sql);

                        if (mysqli_num_rows($result) > 0)  // if there are posts in database
                        {
                            while ($post_data = mysqli_fetch_assoc($result)) {
                                $post_id = $post_data['id'];
                                $user_id = $post_data['user_id'];

                                $sql2 = "SELECT * FROM users WHERE id='$user_id'";
                                $result2 = mysqli_query($db_connection, $sql2);
                                if (mysqli_num_rows($result2) > 0) {
                                    if ($user_data = mysqli_fetch_assoc($result2)) {
                                        $user_name = $user_data['username'];
                                        $user_profile_pic = $user_data['profile_pic'];
                        ?>

                                        <div class="post-header">
                                            <div class="post-header-img">
                                                <img src="<?php echo "../Database/images/" . $user_profile_pic ?>" alt="user profile pic">
                                            </div>
                                            <div class="post-header-name">
                                                <a href="others_profile.php?username=<?php echo $user_name; ?>"><?php echo $user_name; ?></a>
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
                                            <!--  if there is no image then display video -->
                                            <div class="post-video">
                                                <video controls loop muted>
                                                    <source src="<?php echo "../Database/videos/" . $post_data['video'] ?>" type="video/mp4">
                                                </video>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                         <!--  change picture of like when clicked how to do it? ans: using javascript -->
                                        <div class="post-footer">
                                            <div class="post-footer-icons">
                                                <div class="post-footer-icons-left">
                                                    <img src="../src/images/like.png" alt="like">
                                                    <img src="../src/images/Comment.png" alt="comment">
                                                    <img src="../src/images/Share.png" alt="share">
                                                </div>
                                                <div class="post-footer-icons-right">
                                                    <img src="../src/images/saved.png" alt="save">
                                                </div>
                                            </div>
                                            <div class="post-footer-likes">
                                                <?php
                                                $sql3 = "SELECT * FROM likes WHERE post_id='$post_id'";
                                                $result3 = mysqli_query($db_connection, $sql3);
                                                $total_likes = mysqli_num_rows($result3);
                                                if ($total_likes > 0) {
                                                    echo "<span>" . $total_likes . " likes</span>";
                                                } else {
                                                    echo "<span>" . $total_likes . " like</span>";
                                                }
                                                ?>
                                            </div>
                                            <div class="post-footer-caption">
                                                <span>
                                                    <a href="others_profile.php?username=<?php echo $user_name; ?>"><?php echo $user_name; ?></a>
                                                    <?php echo $post_data['caption']; ?>
                                                </span>
                                            </div>
                                            <div class="post-footer-comments">
                                                <?php
                                                $sql4 = "SELECT * FROM comments WHERE post_id='$post_id'";
                                                $result4 = mysqli_query($db_connection, $sql4);
                                                $total_comments = mysqli_num_rows($result4);
                                                if ($total_comments > 0) {
                                                    echo "<span>View all " . $total_comments . " comments</span>";
                                                }
                                                ?>
                                            </div>
                                            <div class="post-footer-time">
                                                <!--  take date from database and convert it into time ago -->
                                                <?php
                                                $time_ago = $post_data['date'];
                                                include('time_ago.php');
                                                ?>
                                            </div>
                                            <div class="post-footer-add-comment">
                                                <input type="text" placeholder="Add a comment...">
                                                <button>Post</button>
                                            </div>
                                        </div>
                                        <hr>

                        <?php
                                    }
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>

            <!--  place it to the almost right side and on the left side of right-sidebar there is content div -->
            <div class="right-sidebar">
                <div class="right-sidebar-header">
                    <div class="right-sidebar-header-img">
                        <?php $profile_pic = $_SESSION['profile_pic']; ?>
                        <img src="<?php echo "../Database/images/" . $profile_pic ?>" alt="user profile pic">
                    </div>
                    <div class="right-sidebar-header-name">
                        <span> <a href="profile.php"> <?php echo $_SESSION['username']; ?></a> </span>
                    </div>
                </div>
                <div class="right-sidebar-suggestions">
                    <div class="right-sidebar-suggestions-header">
                        <span>Suggestions For You</span>
                        <span id="see_all">See All</span>
                    </div>
                    <?php
                    // randomly selct users from database and display them as suggestions
                    $sql3 = "SELECT * FROM users ORDER BY RAND() LIMIT 5";
                    $result3 = mysqli_query($db_connection, $sql3);
                    if (mysqli_num_rows($result3) > 0) {
                        while ($user_data = mysqli_fetch_assoc($result3)) {
                            $user_name3 = $user_data['username'];
                            $user_profile_pic3 = $user_data['profile_pic'];
                    ?>
                            <div class="right-sidebar-suggestions-body">
                                <div class="right-sidebar-suggestions-body-img">
                                    <img src="<?php echo "../Database/images/" . $user_profile_pic3 ?>" alt="user profile pic">
                                </div>
                                <div class="right-sidebar-suggestions-body-name">
                                    <a href="others_profile.php?username=<?php echo $user_name3; ?>"><?php echo $user_name3; ?></a>
                                    <span class="following">Follows you</span>
                                    <span class="follow-btn">Follow</span>
                                </div>
                            </div>
                            <!-- <div class="right-sidebar-suggestions-body-follow">
                                
                            </div> -->
                    <?php
                        }
                    }
                    ?>
                </div>
                <div class="right-sidebar-footer">
                    <span>About</span>
                    <span>Help</span>
                    <span>Press</span>
                    <span>API</span>
                    <span>Jobs</span>
                    <span>Privacy</span>
                    <span>Terms</span>
                    <span>Locations</span>
                    <span>Top Accounts</span>
                    <span>Hashtags</span>
                    <span>Language</span>
                </div>
                <div class="right-sidebar-footer">
                    <span>Beauty</span>
                    <span>Dance</span>
                    <span>Fitness</span>
                    <span>Food & Drink</span>
                    <span>Home & Garden</span>
                    <span>Music</span>
                    <span>Visual Arts</span>
                </div>
                <div class="right-sidebar-footer">
                    <span>© 2023 Instagram from Facebook</span>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
<!-- 
    In order to save the data of the user we need to create a database and a table in it.
    The database name is instagram and the table name is users.
    The table has 5 columns id, username, email, password, date.
    The id is auto increment and the date is also auto increment.
    The username, email, password are varchar(255) and the date is timestamp.
    The username, email, password are not null and the date is null.
    Name of tables in this database are:
    1. users - id(int(11)), username(varchar(255)), email(varchar(255)), password(varchar(255)), date(timestamp), profile_pic(varchar(255))
    2. posts - id(int(11)), user_id(int(11)), image(varchar(255)),video(varchar(225)), caption(varchar(255)), date(timestamp)
    3. comments - id(int(11)), post_id(int(11)), user_id(int(11)), comment(varchar(255)), date(timestamp)
    4. likes - id(int(11)), post_id(int(11)), user_id(int(11)), date(timestamp)
    5. followers - id(int(11)), user_id(int(11)), follower_id(int(11)), date(timestamp)
    6. following - id(int(11)), user_id(int(11)), following_id(int(11)), date(timestamp)
    7. messages - id(int(11)), user_id(int(11)), message(varchar(255)), date(timestamp)
    8. notifications - id(int(11)), user_id(int(11)), notification(varchar(255)), date(timestamp)
    9. saved - id(int(11)), user_id(int(11)), post_id(int(11)), date(timestamp)
    10. tags - id(int(11)), post_id(int(11)), user_id(int(11)), date(timestamp)
    Now the relationship between the tables and their foreign keys are:
    1. posts - user_id is the foreign key of users table
    2. comments - post_id is the foreign key of posts table and user_id is the foreign key of users table
    3. likes - post_id is the foreign key of posts table and user_id is the foreign key of users table
    4. followers - user_id is the foreign key of users table and follower_id is the foreign key of users table
    5. following - user_id is the foreign key of users table and following_id is the foreign key of users table
    6. messages - user_id is the foreign key of users table
    7. notifications - user_id is the foreign key of users table
    8. saved - user_id is the foreign key of users table and post_id is the foreign key of posts table
    9. tags - post_id is the foreign key of posts table and user_id is the foreign key of users table
-->