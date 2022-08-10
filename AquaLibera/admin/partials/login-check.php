<?php

    //Authorization or Access Control
    //Check whether the user is Logged in or Not
    if(!isset($_SESSION['user']))
    {
        //Not Logged In
        $_SESSION['no-login-message'] = "<div class='error'> Please Login to Access Admin Panel </div>"; 
        header('location:'.SITEURL.'admin/3/login.php');
    }
?>