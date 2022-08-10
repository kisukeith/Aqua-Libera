<?php

include('../config/constants.php');

//1. Get the ID of Item to be Deleted
if (isset($_GET['id']) && isset($_GET['image_name']))
{
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    if ($image_name != "")
    {
        $path = "../images/item/".$image_name;

        $remove = unlink($path);

        if ($remove == FALSE)
        {
            $_SESSION['remove'] = "<div class='error>'Failed to Delete. Try Again.</div>";
            header('location:' . SITEURL . 'admin/manage-items.php');
            die();
        }
    }   

    //2. Create SQL Query to Delete Admin
    $sql = "DELETE FROM tbl_items WHERE id=$id";

    //Execute the Query
    $res = mysqli_query($conn, $sql);

    //Checking
    if ($res == TRUE)
    {
        //echo "Executed successfully";
        $_SESSION['delete-item'] = "<div class='success'>Deleted Successfully.</div>";
        header('location:' . SITEURL . 'admin/manage-items.php');
    } else {
        //echo "Failed";

        $_SESSION['delete-item'] = "<div class='error>'Failed to Delete. Try Again.</div>";
        header('location:' . SITEURL . 'admin/manage-items.php');
    }
    //3. Redirecting to Manage Admin Page with Message
}
else
{
    $_SESSION['delete'] = "<div class='error'>Unauthorized Access.</div>";
    header('location:' . SITEURL . 'admin/manage-items.php');
}
?>