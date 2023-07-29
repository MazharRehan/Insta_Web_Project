<?php
session_start();
if (!isset($_SESSION['id'])) {
    echo "<script>alert('Please Login to continue!')</script>";
    header('location:../index.php');
}

include('db_connection.php');

if(isset($_GET['post_id']))
{
    $post_id = $_GET['post_id'];
    $user_id = $_SESSION['id'];

    $qry = "DELETE FROM posts WHERE id = '$post_id' AND user_id = '$user_id'";

   $del = mysqli_query($db_connection, $qry);

    if($del){
        echo "<script>alert('A post has been deleted!')</script>";
        echo "<script>window.open('profile.php','_self')</script>"; //redirect to profile page
        // difference between header and window.open is that header is used to redirect to a page and window.open is used to open a new tab
    }
    else{
        echo "<script>alert('A post has not been deleted!')</script>";
        echo "<script>window.open('profile.php','_self')</script>"; 
    }

}

?>