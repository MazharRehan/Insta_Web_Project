<?php
// logout 
session_start();
if (!isset($_SESSION['id'])) 
{
    header('location:../index.php');
}

session_destroy();
header("Location: ../index.php");
exit; // Exit is used to stop the script from running

?>