<?php include('partials/menu.php')?>

<div class="main-content">
    <div class="wrapper">
        <h2>Update Admin</h2>
        <br>

        <?php
            //1. Get Id of the Admin
            $id = $_GET['id'];

            //2. Create Sql Query
            $sql = "SELECT * FROM tbl_admin WHERE id=$id";

            //Execute Query
            $res = mysqli_query($conn , $sql);

            //Checking
            if($res==TRUE)
            {
                $count = mysqli_num_rows($res);
                if($count==1)
                {
                    //echo 'Admin Available';
                    $row = mysqli_fetch_assoc($res);
                    $full_name = $row['full_name'];
                    $username = $row['username'];
                }
                else
                {
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
        ?>
        
        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name?>">
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id?>">
                        <br/><br/>
                        <input type="submit" name="submit" value="Update Admin" class="btn-update">
                    </td>
                </tr>
            </table>

        </form>

    </div>
</div>

<?php
    //Checking whether the Update Button is Clicked

    if(isset($_POST['submit']))
    {
        //echo "Button Clicked";
        //Getting the Values
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];

        //Creating a SQL Query to Update

        $sql = "UPDATE tbl_admin SET
        full_name = '$full_name',
        username = '$username'
        WHERE id='$id'
        ";

        //Execute Query
        $res = mysqli_query($conn , $sql);

        //Check

        if($res==TRUE)
        {
            $_SESSION['update'] = "<div class='success'> Admin Updated Succesfully. </div>";
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
        else
        {
            $_SESSION['update'] = "<div class='error'> Failed to Update. </div>";
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
    }
?>

<?php include('partials/footer.php')?>