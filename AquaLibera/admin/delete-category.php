<?php

include('../config/constants.php');

//1. Get the ID of Category to be Deleted
if (isset($_GET['id']) AND isset($_GET['image_name']))
{
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    if ($image_name != "")
    {
        $path = "../images/category/".$image_name;

        $remove = unlink($path);

        if ($remove == FALSE)
        {
            $_SESSION['remove'] = "<div class='error>'Failed to Delete. Try Again.</div>";
            header('location:' . SITEURL . 'admin/manage-categories.php');
            die();
        }
    }   

    //2. Create SQL Query to Delete Admin
    $sql = "DELETE FROM tbl_categories WHERE id=$id";

    //Execute the Query
    $res = mysqli_query($conn, $sql);

    //Checking
    if ($res == TRUE)
    {
        //echo "Executed successfully";
        $_SESSION['delete'] = "<div class='success'>Deleted Successfully.</div>";
        header('location:' . SITEURL . 'admin/manage-categories.php');
    } else {
        //echo "Failed";

        $_SESSION['delete'] = "<div class='error>'Failed to Delete. Try Again.</div>";
        header('location:' . SITEURL . 'admin/manage-categories.php');
    }



    //3. Redirecting to Manage Admin Page with Message
}
else
{
    header('location:' . SITEURL . 'admin/manage-categories.php');
}
?>
