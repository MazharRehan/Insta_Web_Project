<?php

//DB Connection File / Module
define('HOST', 'localhost');
define('DB_USER', 'root');
define('DB_USER_PASSWORD', '');
define('DB_NAME', 'instagram');       // Need database for online_store

$db_connection = mysqli_connect(HOST, DB_USER, DB_USER_PASSWORD, DB_NAME);

if (!$db_connection) {
    echo 'DB_NOT_CONNECTED<br>';
    echo 'Error: '.mysqli_connect_error();  // dislay error message
}

?>