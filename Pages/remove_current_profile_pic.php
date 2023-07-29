<?php
// remore current profile pic of the logged in user
session_start();
if (!isset($_SESSION['id'])) {
    session_destroy();
    header("Location: login.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if ($_GET['remove_profile_pic_request'] == True) {
        $user_id = $_SESSION['id'];
        include('db_connection.php');

        $qry = "UPDATE users SET profile_pic = 'profile.png' WHERE id = '$user_id'";
        $result = mysqli_query($db_connection, $qry);

        if ($result) {
            $_SESSION['profile_pic'] = 'profile.png';
            echo "<script>alert('Profile pic has been removed!')</script>";
            echo "<script>window.open('profile.php','_self')</script>"; //redirect to profile page
        } else {
            echo "<script>alert('Profile pic has not been removed!')</script>";
            echo "<script>window.open('profile.php','_self')</script>";
        }
    }
} else
    header("location: profile.php");
?>
