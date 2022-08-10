<?php 

    ob_start();
    //Start Session
    session_start();

    //Create constants to store NON-Repeating Values

    define('SITEURL' , 'http://localhost/AquaLibera/');
    define('LOCALHOST' , 'localhost');
    define('DB_USERNAME' , 'root');
    define('DB_PASSSWORD' , '');
    define('DB_NAME' , 'aqualibera');

    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSSWORD) or die(mysqli_error($conn));
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn));
?>