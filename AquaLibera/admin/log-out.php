<?php

    //Include constants.php
    include('../config/constants.php');

    //1. Destroy Sessions
    session_destroy(); //unsets $_SESSION['user']

    //2. Redirect to Login Form
    header('location:'.SITEURL.'admin/3/login.php');
?>