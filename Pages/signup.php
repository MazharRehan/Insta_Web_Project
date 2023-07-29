<!-- sign up page for instagram website -->
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        $email = $_POST["email"];
        $fullname = $_POST["fullname"];
        $username = $_POST["username"];
        $password = MD5($_POST["password"]);

        include('db_connection.php');

        //Step-03 Data Save into DB
        $save_qry = "INSERT INTO users (email, fullname, username, password) VALUES ('$email', '$fullname', '$username', '$password')";

        //  Step-04: Excute the Query
        $result = mysqli_query($db_connection, $save_qry);

        if ($result) {
            header('location: ../index.php'); // redirect to login page
        }
        else {
            echo "SQL Data Insertion Error: " . $save_qry . "<br>" . mysqli_error($db_connection);
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up - Instagram</title>
    <link rel="stylesheet" href="../css/signup.css">
</head>

<body>
    <main>
        <section class="signupSection">
            <section class="signup-form">
                <img src="../src/images/instagram-logo.png" alt="Instagram Logo">
                <h3 class="signup-tagline">Sign up to see photos and videos from your friends.</h3>
                <input class="login-btn" type="submit" name="login" value="Log in with Facebook"></input>
                <hr class="hr-left">
                <p class="or-text"> OR </p>
                <hr class="hr-right">

                <form action="signup.php" method="post">
                    <input class="user-input" type="email" name="email" placeholder="Mobile Number or Email">
                    <input class="user-input" type="text" name="fullname" placeholder="Full Name">
                    <input class="user-input" type="text" name="username" placeholder="Username">
                    <!--  validate that the username is not alreally taken -->

                    <input class="user-input" type="password" name="password" placeholder="Password">
                    <input class="signup-btn" type="submit" name="submit" value="Sign up">

                </form>
                <span class="terms-conditions">
                    People who use our service may have uploaded your contact information to Instagram. <a href="https://www.facebook.com/help/instagram/261704639352628">Learn more</a>
                    <br><br><br>
                    By signing up, you agree to our <a href="https://help.instagram.com/581066165581870/?locale=en_GB">Terms</a>, <a href="https://www.facebook.com/privacy/policy">Data Policy</a> and <a href="https://help.instagram.com/1896641480634370/">Cookies Policy</a>.
                </span>
            </section>
        </section>
        <section class="loginSection">
            <p>Have an account? <a href="../index.php">Log in</a></p>
        </section>
    </main>
</body>

</html>