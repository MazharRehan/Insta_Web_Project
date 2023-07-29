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
        .content {
            margin-left: 200px;
            width: 75%;

        }

        .post-video {
            position: relative;
            width: 100%;
            box-shadow: 0px 0px 40px 0px rgba(0, 0, 0, 0.5);
            margin: 10px;
            border-radius: 12px;
            background-color: #f5f5f5
        }

        .post-video video {
            height: 100%;
            width: 100%;
            object-fit: cover;
            border-radius: 10px;
        }

        .post-header {
            position: absolute;
            bottom: 0;
            width: 100%;
            background-color: transparent;
            height: 110px;
        }

        .post-header-name a {
            color: white;
        }

        .post-caption {
            position: absolute;
            bottom: 0;
            width: 100%;
            background-color: transparent;
            color: white;
            padding: 10px;
        }

        .post-caption p {
           margin-left: 50px;
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
                        <!--  i want to add horizontal line after every post. How can i do that? ans: use <hr> tag -->
                        <!--  where should i add <hr> tag, means after which div? ans: after post-header -->
                        <?php
                        include('db_connection.php');
                        // select only videos
                        $sql = "SELECT * FROM posts WHERE video IS NOT NULL ORDER BY RAND()";

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


                                        <?php
                                        if (!empty($post_data['video'])) {
                                        ?>
                                            <div class="post-video">
                                                <video controls autoplay loop muted>
                                                    <source src="<?php echo "../Database/videos/" . $post_data['video'] ?>" type="video/mp4">
                                                </video>
                                                <div class="post-header">
                                                    <div class="post-header-img">
                                                        <img src="<?php echo "../Database/images/" . $user_profile_pic ?>" alt="user profile pic">
                                                    </div>
                                                    <div class="post-header-name">
                                                        <a href="others_profile.php?username=<?php echo $user_name; ?>"><?php echo $user_name; ?></a>
                                                    </div>
                                                    <div class="post-caption">
                                                        <p><?php echo $post_data['caption']; ?></p>
                                                    </div>
                                                </div>

                                            </div>
                                        <?php
                                        } else
                                            continue;
                                        ?>
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
        </div>
    </main>
</body>

</html>