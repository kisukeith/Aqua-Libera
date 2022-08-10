<?php include('partials/menu.php'); ?>
<!--Main Content-->
<div class="main-content">
    <div class="wrapper">
        <h2>Manage Admin</h2>
        <br>
        <?php
        if (isset($_SESSION['add']))
        {
            echo $_SESSION['add']; //Display
            unset($_SESSION['add']); //Remove Message
        }
        if (isset($_SESSION['delete']))
        {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if (isset($_SESSION['update']))
        {
            echo$_SESSION['update'];
            unset($_SESSION['update']);
        }
        if (isset($_SESSION['user-not-found']))
        {
            echo$_SESSION['user-not-found'];
            unset($_SESSION['user-not-found']);
        }
        if (isset($_SESSION['pwd-not-match']))
        {
            echo$_SESSION['pwd-not-match'];
            unset($_SESSION['pwd-not-match']);
        }
        if (isset($_SESSION['change-pwd']))
        {
            echo$_SESSION['change-pwd'];
            unset($_SESSION['change-pwd']);
        }
        if (isset($_SESSION['failed-pwd']))
        {
            echo$_SESSION['failed-pwd'];
            unset($_SESSION['failed-pwd']);
        }
        ?>

        <br/><br/><br/>

        <!-- Button to Add Admins -->
        <a href="add-admin.php" class="btn-primary">Add Admin</a>
        <!-- End -->

        <br /><br />

        <table class="tbl-full">
            <tr>
                <th>ID No.</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>

            <?php
                //Query to Get all Admin
                $sql = "SELECT * FROM tbl_admin";
                //Execute the Query
                $res = mysqli_query($conn , $sql);
                //Check whether the Query is Executed or Not

                if($res==TRUE)
                {
                    //Checking
                    $count = mysqli_num_rows($res);

                    $sn=1; //Create a Variable and Assign the Value

                    if($count>0)
                    {
                        while($rows = mysqli_fetch_assoc($res))
                        {
                            $id=$rows['id'];
                            $full_name=$rows['full_name'];
                            $username=$rows['username'];

                            //Display
                            ?>

                            <tr>
                                <td><?php echo $sn++;?> </td>
                                <td><?php echo $full_name;?></td>
                                <td><?php echo $username;?></td>
                                <td class="td-adminactions">
                                    <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id;?>" class="btn-primary">Change Password</a>
                                    <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id;?>" class="btn-update">Update Admin</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id;?>" class="btn-delete">Delete Admin</a>
                                </td>
                            </tr>

                            <?php

                        }   
                    }
                    else
                    {

                    }
                }
            ?>

        </table>

    </div>
</div>
<!--End-->
<?php include('partials/footer.php');?>