<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h2>Change Password</h2>
        <br>

        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        ?>

        <form action="" method="POST">

            <table class="tbl-40">
                <tr>
                    <td>Current Password: </td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password">
                    </td>
                </tr>

                <tr>
                    <td>New Password: </td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>

                <tr>
                    <td>Confirm Password: </td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-primary">
                    </td>
                </tr>

            </table>

        </form>

    </div>
</div>


<?php

//Checking
if (isset($_POST['submit'])) {
    //echo "click";
    //1. Getting the Data from  Form
    $id = $_POST['id'];
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);

    //2. Checking whether they exist
    $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

    //Execute
    $res = mysqli_query($conn, $sql);

    if ($res == TRUE) {
        $count = mysqli_num_rows($res);

        if ($count == 1) {
            //Exist and Can Be Changed
            //echo "User Found";
            //Checking
            if ($new_password == $confirm_password) {
                //Update Password
                $sql2 = "UPDATE tbl_admin SET 
                    password = '$new_password'
                    WHERE id=$id
                ";

                //Execute Query
                $res2 = mysqli_query($conn, $sql2);

                //Checking

                if ($res2 == TRUE) {
                    $_SESSION['change-pwd'] = "<div class='success'> Password Changed Successfully. </div>";
                    header('location:' . SITEURL . 'admin/manage-admin.php');
                } else {
                    $_SESSION['failed-pwd'] = "<div class='error'> Password Change Failed. </div>";
                    header('location:' . SITEURL . 'admin/manage-admin.php');
                }
            } else {
                $_SESSION['pwd-not-match'] = "<div class='error'> The Password Did Not Match. </div>";
                header('location:' . SITEURL . 'admin/manage-admin.php');
            }
        } else {
            //Doesn't Exist
            $_SESSION['user-not-found'] = "<div class='error'> User Not Found </div>";
            header('location:' . SITEURL . 'admin/manage-admin.php');
        }
    }
}
?>

<?php include('partials/footer.php') ?>