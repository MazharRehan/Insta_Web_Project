<?php
session_start();
if (!isset($_SESSION['id'])) {

    header('location:../index.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = $_SESSION['id']; // user id
    $caption = $_POST['caption']; // caption of the post

    $file = $_FILES['file'];
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name']; //temporary location
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png', 'mp4');

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if (!empty($file)) {
                if ($fileSize < 100000000)  //100mb
                {
                    $fileNameNew = uniqid('', true) . "." . $fileActualExt; //to make the name of the file unique
                    // Database Connection
                    include('db_connection.php');

                    if ($fileActualExt == 'jpg' || $fileActualExt == 'jpeg' || $fileActualExt == 'png') {
                        $fileDestination = '../Database/images/' . $fileNameNew;
                        move_uploaded_file($fileTmpName, $fileDestination);
                        //Data Save into DB
                        $save_qry = "INSERT INTO posts (user_id, image, caption) VALUES ( '$id', '$fileNameNew', '$caption')";
                    } else {
                        $fileDestination = '../Database/videos/' . $fileNameNew;
                        move_uploaded_file($fileTmpName, $fileDestination);
                        $save_qry = "INSERT INTO posts (user_id, video, caption) VALUES ( '$id', '$fileNameNew', '$caption')";
                    }
                    //Excute the Query
                    $result = mysqli_query($db_connection, $save_qry);

                    if ($result)
                        header('location: profile.php?uploadsuccess'); // uploassuccess is a get request which is used to display a message that the file has been uploaded successfully
                    else
                        echo "Error: " . $qry . "<br>" . mysqli_error($db_connection);
                } else
                    echo "Your file is too big! (Max 100mb)";
            } else
                echo "You need to select a file first!";
        } else
            echo "There was an error uploading your file!";
    } else
        echo "You cannot upload files of this type!";
}
?>
<!-- Here user can create new post and upload it in his/hi profile -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Post</title>
    <style>
        .popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }

        .popup-content {
            background-color: #fff;
            padding: 20px;
            text-align: center;
        }

        .close-popup {
            margin-top: 10px;
        }

        /* Optional: Style the "Create" button */
        .create-button {
            display: inline-block;
            padding: 10px;
            background-color: #f9f9f9;
        }

        .create-button img {
            vertical-align: middle;
            margin-right: 5px;
        }

        .create-button:hover {
            background-color: #ddd;
        }

        /* improving the css of the .popup-content and the form */

        .popup-content {
            width: 500px;
            max-width: 100%;
            padding: 20px;
            box-sizing: border-box;
            position: relative;
        }

        .popup-content h2 {
            margin-top: 0;
        }

        .popup-content form {
            margin: 20px 0;
        }

        .popup-content form input[type="file"] {
            display: block;
            margin: 10px 0;
        }

        .popup-content form input[type="submit"] {
            display: block;
            margin: 10px auto;
            padding: 10px;
            border: 1px solid  #00a2ff;
            cursor: pointer;
            color: #ffffff;
            background-color: #00a2ff;
        }

        .popup-content form textarea {
            display: block;
            margin: 10px 0;
            width: 100%;
            height: 100px;
            resize: none;
        }

        .popup-content form label {
            display: block;
            margin-bottom: 5px;
        }

        .close-popup {
            right: 10px;
            padding: 10px;
            background-color:#00a2ff;
            border: 1px solid  #00a2ff;
            cursor: pointer;
        }

        #file{
            width: 100%;
            border: #00a2ff 1px solid;
            background-color: #b886ff;;
        }
        
    </style>
</head>

<body>
    <div class="popup-overlay">
        <div class="popup-content">
            <h2>Create New Post</h2>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data"> <!-- here action refers to the current page -->
                <label for="file">Choose a video or image to upload:</label> <br>
                <input type="file" name="file" id="file" accept="image/*, video/*, .jpg, .jpeg, .png, .mp4" max-size="100000000" required oninvalid="this.setCustomValidity('You need to select a file first!')" oninput="this.setCustomValidity('')"> <br>
                <label for="caption">Caption:</label> <br>
                <textarea name="caption" id="caption" cols="30" rows="10"></textarea> <br>
                <input type="submit" name="submit" value="Upload"> <br>
            </form>
            <input class="close-popup" type="button" value="Close" onclick="window.location.href='home.php'">
        </div>
    </div>
</body>

</html>