<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h2>Add Admin</h2>
        <br>

        <?php
            if (isset($_SESSION['add']))
            {
                echo $_SESSION['add']; //Display
                unset($_SESSION['add']); //Remove Message
            }
        ?>

        <form action="#" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter Your Name">
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="username" placeholder="Enter Your Username"></td>
                </tr>

                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="password" placeholder="Enter Your Password"></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <br/><br/>
                        <input type="submit" name="submit" value="Add Admin" class="btn-primary">
                    </td>
                </tr>

            </table>

        </form>
    </div>
</div>

<?php include('partials/footer.php');?>


<?php
    //Process the Value From Form and Save it in Database

    //Check whether the Submit Button is Clicked or not

    if(isset($_POST['submit']))
    {
        //Button Clicked
        //echo "Button Clicked";

        //1. Getting the data to the Form

        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        
        // Password Encryption with mD5

        //2. SQL Query to save the data to the Database

        $sql = "INSERT INTO tbl_admin SET
            full_name = '$full_name',
            username = '$username' ,
            password = '$password'
        ";

        //3. Executing query and Saving Data into the Database

        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        //4. Check whether the (query is Executed) data is inserted or not and Display appropriate message

        if($res == TRUE)
        {
            //echo 'Data is Inserted';
            //Create a Seession variable to Display Message

            $_SESSION['add'] = "<div class='success'> Admin Added Successfully. </div>";
            //Redirect Page to Manage Admin
            header("location:" .SITEURL.'admin/manage-admin.php');
        }
        else
        {
            //Create a Seession variable to Display Message

            $_SESSION['add'] = "<div class='error'> Failed to add the Admin. Try Again. </div>";
            //Redirect Page to Add Admin
            header("location:" .SITEURL.'admin/add-admin.php');
        }
    }
?>