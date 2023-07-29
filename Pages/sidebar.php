<?php
$profile_pic = $_SESSION['profile_pic'];
?>
<style>
    #sidebar-more-options {
        visibility: hidden;
        opacity: 0;
    }
</style>
<div class="sidebar">
    <img class="sidebar-insta-logo" src="../src/images/instagram-logo.png" alt="Instagram Logo">
    <a href="home.php"><img class="sidebar-icon" src="../src/images/home.png" alt="icon"> Home</a>
    <a href="#"><img class="sidebar-icon" src="../src/images/search.png" alt="icon"> Search</a>
    <a href="#"><img class="sidebar-icon" src="../src/images/explore.png" alt="icon"> Explore</a>
    <a href="reels.php"><img class="sidebar-icon" src="../src/images/reels.png" alt="icon"> Reels</a>
    <a href="#"><img class="sidebar-icon" src="../src/images/massenger.png" alt="icon"> Messages</a>
    <a href="#"><img class="sidebar-icon" src="../src/images/like.png" alt="icon"> Notifications</a>
    <a href="createNewPost.php"><img class="sidebar-icon" src="../src/images/add.png" alt="icon"> Create</a>
    <a href="profile.php" class="sidebar-profile">
        <span class="sidebar-icon-profile">
         <img class="sidebar-icon-profile-pic" src="<?php echo "../Database/images/" . $profile_pic ?>" alt="user profile pic"> 
         </span>
         <span class="sidebar-icon-profile-name">
         Profile
         </span>
       
        </a>


    <div class="sidebar-more">
        <div class="sidebar-more-btn">
           <a href="#sidebar-more-options" id="moreButton"> <img class="sidebar-icon" src="../src/images/more-3lines.png" alt="more"> More </a>
        </div>
        <div class="sidebar-more-options" id="sidebar-more-options">
            <div class="sidebar-more-options-body">
                <div class="sidebar-more-options-body-option">
                    <a href="#"><img class="sidebar-more-icon" src="../src/images/settings.png" alt="settings"> Settings</a>
                </div>
                <div class="sidebar-more-options-body-option">
                    <a href="#"><img class="sidebar-more-icon" src="../src/images/activity.png" alt="your-avtivity-icon"> Your Activity</a>
                </div>
                <div class="sidebar-more-options-body-option">
                    <a href="#"><img class="sidebar-more-icon" src="../src/images/saved.png" alt="saved"> Saved</a>
                </div>

                <div class="sidebar-more-options-body-option">
                    <a href="#"><img class="sidebar-more-icon" src="../src/images/appearance.png" alt="switch-appearance-icon"> Switch appearance</a>
                </div>
                <div class="sidebar-more-options-body-option">
                    <a href="#"><img class="sidebar-more-icon" src="../src/images/report_problem.png" alt="repost-problem-icon"> Report a problem</a>
                </div>
                <div class="sidebar-more-options-body-option">
                    <a href="#"> Switch accounts </a>
                </div>
                <div class="sidebar-more-options-body-option">
                    <a href="logout.php"> Logout</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // Sidebar More Options
    /*  when user click on more button then change the sidebar-more-options to visible and opacity to 1 */

    var moreButton = document.getElementById("moreButton");
    var sidebarMoreOptions = document.getElementById("sidebar-more-options");

    moreButton.addEventListener("click", function() {
        // it display the sidebar-more-options even when the user dont click on the more button. It display when the page is loaded. So we need to hide it when the page is loaded. By default it is hidden.

        if (sidebarMoreOptions.style.visibility == "visible") {
            sidebarMoreOptions.style.visibility = "hidden";
            sidebarMoreOptions.style.opacity = "0";
        } else {
            sidebarMoreOptions.style.visibility = "visible";
            sidebarMoreOptions.style.opacity = "1";
        }

    });
    
  </script>