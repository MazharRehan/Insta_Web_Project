<!--  building the forgot password page of instagram -->
<?php
    session_start();
    if (!isset($_SESSION['id'])) 
    {
        header('location:../index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="../css/sidebar.css">
</head>
<body>
<main>
    <main>
        <?php include 'sidebar.php'; ?>
    </main>
</body>
</html>