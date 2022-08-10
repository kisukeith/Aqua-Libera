<?php

include('../config/constants.php');

//1. Get the ID of Admin to be Deleted
$id = $_GET['id'];


//2. Create SQL Query to Delete Admin
$sql = "DELETE FROM tbl_admin WHERE id=$id";

//Execute the Query
$res = mysqli_query($conn, $sql);

//Checking
if ($res == TRUE) {
    //echo "Executed successfully";
    $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully.</div>";
    header('location:' . SITEURL . 'admin/manage-admin.php');
} else {
    //echo "Failed";

    $_SESSION['delete'] = "<div class='error>'Failed to Delete Admin. Try Again.</div>";
    header('location:' . SITEURL . 'admin/manage-admin.php');
}

    //3. Redirecting to Manage Admin Page with Message
