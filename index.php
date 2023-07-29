<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        $username = $_POST["username"];
        $password = MD5($_POST["password"]);

        include('./Pages/db_connection.php');

        $qry = 'SELECT id, username, email, fullname, profile_pic, password FROM users';

        $result = mysqli_query($db_connection, $qry);

        if ($result) 
        {
            session_start();
            while ($row = mysqli_fetch_assoc($result)) 
            {
                // user can login with username or email
                if (($row['username'] == $username || $row['email'] == $username) && $row['password'] == $password)
                {
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['fullname'] = $row['fullname'];
                    $_SESSION['profile_pic'] = $row['profile_pic'];

                    header('location:./Pages/home.php');
                }
            }
            // if user not found
            $_SESSION['login_error'] = 'Invalid username or password';
        } 
        else 
        {
            echo 'Error: '.mysqli_error($db_connection);
        }
    }

?>

<!-- login page for instagram website -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in - Instagram</title>
    <link rel="stylesheet" href="./css/index.css">
</head>

<body>
    <main>
        <div class="login-section">
            <img src="src/images/instagram-logo.png" alt="">
            <div class="login-form">
                <form action="index.php" method="post" enctype="multipart/form-data">
                    <input class="user-input" type="text" name="username"
                        placeholder="Phone number, username or email address">
                    <input class="user-input" type="password" name="password" placeholder="Password">
                    <input class="login-btn" type="submit" value="Log in">
                    <div style="color: red;">
                        <?php
                        if (isset($_SESSION['login_error'])) 
                        {
                            echo $_SESSION['login_error'];
                            unset($_SESSION['login_error']);
                        }
                        ?>
                    </div>
                    <p>OR</p>
                    <a class="forget-pass" href="./Pages/forgot_password.php">Forgot password?</a>
                </form>
            </div>
        </div>
        <!-- signup page link -->
        <div class="signupSection">
            <p>Don't have an account? <a href="./Pages/signup.php">Sign up</a></p>
        </div>
    </main>
</body>

</html>