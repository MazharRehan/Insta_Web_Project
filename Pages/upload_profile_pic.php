<!-- upload_profile_pic.php -->
<?php

session_start();
if (!isset($_SESSION['id'])) {
      header("Location: login.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $user_id = $_SESSION['id'];
      $user_name = $_SESSION['username'];
      $file = $_FILES['file'];
      $fileName = $_FILES['file']['name'];
      $fileTmpName = $_FILES['file']['tmp_name']; //temporary location
      $fileSize = $_FILES['file']['size'];
      $fileError = $_FILES['file']['error'];
      $fileType = $_FILES['file']['type'];

      $fileExt = explode('.', $fileName);
      $fileActualExt = strtolower(end($fileExt));

      $allowed = array('jpg', 'jpeg', 'png');

      if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                  if (!empty($file)) {
                        if ($fileSize < 100000000)  //100mb
                        {
                              // make the name of the file unique with the combination of user name and date
                              $fileNameNew = $user_name . date('YmdHis') . "." . $fileActualExt;
                              // Database Connection
                              include('db_connection.php');

                              $fileDestination = '../Database/images/' . $fileNameNew;
                              move_uploaded_file($fileTmpName, $fileDestination);
                              //Data Save into DB
                              $save_qry = "UPDATE users SET profile_pic = '$fileNameNew' WHERE id = '$user_id'";
                              //Excute the Query
                              $result = mysqli_query($db_connection, $save_qry);

                              if ($result){
                                    $_SESSION['profile_pic'] = $fileNameNew; // update the session variable with the new profile pic bsc profile pic is set only at the login time so otherwise will be updated only after logout
                                    header('location: profile.php?uploadsuccess'); // uploassuccess is a get request which is used to display a message that the file has been uploaded successfully
                                   
                              }
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
}else
      header("location: profile.php");

?>