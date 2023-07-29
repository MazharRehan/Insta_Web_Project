<!--  building the profile page of instagram for the user to see their information and edit it if they want to  -->
<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('location:../index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile @<?php echo $_SESSION['username']; ?></title>
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="../css/home.css">
    <link rel="stylesheet" href="../css/profile.css">
    <style>
        .post-more-opt {
            position: absolute;
            left: 0;
            background-color: #f9f9f9;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s, visibility 0.3s;
            z-index: 1;
            width: 200px;
        }

        .post-more-opt ul {
            list-style: none;
            margin: 0;
            padding: 10px;
        }

        .post-more-opt ul li {
            padding: 10px;
            cursor: pointer;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            color: black;
        }

        .post-more-opt ul li:hover {
            background-color: #f1f1f1;
        }

        .post-header-more {
            margin-top: auto;
            margin-bottom: 10px;
            position: relative;
            display: inline-block;
        }

        .post-header-more:hover .post-more-opt {
            opacity: 1;
            visibility: visible;
            top: calc(100% + 10px);
        }

        #delete {
            text-decoration: none;
            color: red;
        }

        /*  change profile pic section  */
        .change_profile_pic {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1;
        }

        .change_profile_pic_options {
            width: 400px;
            height: 230px;
            background-color: white;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .change_profile_pic_header {
            width: 100%;
            height: 80px;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            border-bottom: 1px solid #dbdbdb;
        }

        .change_profile_pic_header h3 {
            font-size: 22px;
            font-weight: 500;
        }

        .change_profile_pic_option {
            width: 100%;
            height: 50px;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            border-bottom: 1px solid #dbdbdb;
            cursor: pointer;
        }

        #cancel_pf_upl_options {
            font-weight: 500;
            font-size: 18px;
        }

        .change_profile_pic_option span {
            font-size: 15px;
            font-weight: 600;
        }

        .change_profile_pic_option:hover {
            background-color: #f9f9f9;
        }

        .change_profile_pic_option:last-child {
            border-bottom: none;
        }

        #upload_profile_photo {
            color: #0095f6;
        }

        #remove_current_photo {
            color: red;
        }
    </style>
</head>

<body>
    <main>
        <?php
        $user_name = $_SESSION['username'];
        $user_profile_pic = $_SESSION['profile_pic'];
        ?>
        <?php include 'sidebar.php'; ?>
        <div class="profile_section">
            <div class="profile_centent">
                <div class="profile_header">
                    <div class="profile_image">
                        <img src="<?php echo "../Database/images/" . $user_profile_pic ?>" alt="user profile pic">
                    </div>
                    <div class="user_profile_info">
                        <div class="user_profile_name">
                            <h1><?php echo $user_name; ?></h1>
                            <a href="#change_profile_pic">Change Profile Photo</a>
                        </div>
                        <ul class="user_profile_details">
                            <li class="profile_posts"> 1 Posts </li>
                            <li class="user_followers"> 100 Followers </li>
                            <li class="user_following"> 10 Following </li>
                        </ul>
                        <div class="user_profile_bio">
                            <h3><?php echo $_SESSION['fullname']; ?></h3>
                            <p>Turned my dreams into my vision and my vision into my reality.</p>
                        </div>
                    </div>
                </div>
                <!--  horizontal line  -->
                <hr>
                <!--  change profile pic section  -->
                <!--  display this section when user clicks on change profile photo. Display it at the center of the screen and dull the background. Use javascript to do this  -->
                <!--  where i have to add javascript code? ans: in the bottom of the page after the main tag  -->
                <div class="change_profile_pic" id="change_profile_pic">
                    <div class="change_profile_pic_options">
                        <div class="change_profile_pic_header">
                            <h3>Change Profile Photo</h3>
                        </div>
                        <div class="change_profile_pic_option" id="upload_profile_photo">
                            <span id="upload_button">Upload Photo</span>
                        </div>
                        <div class="change_profile_pic_option" id="remove_current_photo">
                            <span>Remove Current Photo</span>
                        </div>
                        <div class="change_profile_pic_option" id="cancel_pf_upl_options">
                            Cancel
                        </div>
                    </div>
                </div>
                <!-- adding input tag of type file to take image from user -->
                <form id="profile_pic_form" action="upload_profile_pic.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="file" id="profile_pic_input" style="display: none;">
                    <input type="submit" name="btn-upload" id="upload_prof_btn"style="display: none;">
                </form>

               
                <h3 class="post_headline">Posts</h3>
                <div class="post-section">
                    <div class="post">
                        <?php
                        include('db_connection.php');

                        $user_id = $_SESSION['id'];
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
                                        <a href="profile.php?username=<?php echo $user_name; ?>"><?php echo $user_name; ?></a>
                                    </div>
                                    <div class="post-header-more">
                                        <div class="post-header-3dot">
                                            <img src="../src/images/More.png" alt="3dot">
                                        </div>
                                        <div class="post-more-opt">
                                            <ul class="post-more-opt-list">
                                                <li>
                                                    <a id="delete" href="delete_post.php?post_id=<?php echo $post_id; ?>" onclick="return confirm('Do you want to delete this post?')">Delete</a>
                                                </li>
                                                <li>Edit</li>
                                                <li>Go to post</li>
                                                <li>Share to...</li>
                                                <li>Copy link</li>
                                                <li>Embed</li>
                                                <li>Cancel</li>
                                            </ul>
                                        </div>
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
                                        <video controls loop muted> <!--autoplay -->
                                            <!-- autoplay video and loop and muted play video automatically and loop it and muted it, close the video when it is not on screen means when it is not in focus -->
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
                                        <span>0 likes</span>
                                    </div>
                                    <div class="post-footer-caption">
                                        <span><a href="profile.php?username=<?php echo $user_name; ?>"><?php echo $user_name; ?></a> <?php echo $post_data['caption']; ?></span>
                                    </div>
                                    <div class="post-footer-time">
                                        <!--  take date from database and convert it into time ago -->
                                        <?php
                                        $time_ago = $post_data['date'];
                                        include('time_ago.php');
                                        ?>
                                    </div>
                                    <div class="post-footer-comments">
                                        <span>0 comments</span>
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

    <!-- javascript code to display the change profile pic section and handle file upload -->
    <script>
       // get the change profile pic section
       var change_profile_pic = document.getElementById('change_profile_pic');
        // get the change profile pic option
        var change_profile_pic_option = document.getElementsByClassName('change_profile_pic_option');
        // get the cancel option
        var cancel = change_profile_pic_option[2];
        // get the change profile pic button
        var change_profile_pic_btn = document.querySelector('.user_profile_name a');
        // get the body tag
        var body = document.querySelector('body');
        // get the upload button
        var upload_button = document.getElementById('upload_button');
        // get the profile pic input
        var profile_pic_input = document.getElementById('profile_pic_input');
        // get the upload profile button
        var upload_prof_btn = document.getElementById('upload_prof_btn');
        // get the remove current photo option
        var remove_current_photo = document.getElementById('remove_current_photo');

        // when user clicks on upload photo option
        upload_button.addEventListener('click', function() {
            // trigger the click event on profile pic input
            profile_pic_input.click();
        });

        // when user selects a file
        profile_pic_input.addEventListener('change', function() {
            // trigger the click event on upload profile button
            upload_prof_btn.click();
        });
        
        // when user clicks on remove current photo option
        remove_current_photo.addEventListener('click', function() {
            // remove the profile pic from database
            window.location.href = "remove_current_profile_pic.php?remove_profile_pic_request=True";
        });
        
        // when user clicks on change profile pic button
        change_profile_pic_btn.addEventListener('click', function() {
            // display the change profile pic section
            change_profile_pic.style.display = 'flex';
        });

        // when user clicks on cancel option
        cancel.addEventListener('click', function() {
            // hide the change profile pic section
            change_profile_pic.style.display = 'none';
            // make the background normal
            body.style.backgroundColor = 'white';
        });

        
    </script>
</body>

</html>