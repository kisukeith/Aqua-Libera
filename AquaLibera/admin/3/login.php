<?php include('..//..//config/constants.php');?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Aqua Libera</title>
    <link rel="stylesheet" type="text/css" href="../3/style.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <img class="wave" src="wave.png">
    <div class="container">
        <div class="img">
            <img src="bg.png">
        </div>
        <div class="login-content">
            <form action="" method="POST">
                <img src="avatar.png">
                <h3 class="title">Aqua Libera Admin Panel</h3>
                <br>

                <?php
                if (isset($_SESSION['login']))
                {
                    echo $_SESSION['login']; //Display
                    unset($_SESSION['login']); //Remove Message
                }
                if (isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message']; //Display
                    unset($_SESSION['no-login-message']); //Remove Message
                }
                ?>

                <br>

                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>Username</h5>
                        <input type="text" name="username" class="input">
                    </div>
                </div>
                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Password</h5>
                        <input type="password" name="password" class="input">
                    </div>
                </div>
                <a href="#">Forgot Password?</a>
                <input type="submit" name="submit" class="btn" value="Login">
            </form>

        </div>
    </div>
    <script type="text/javascript" src="main.js"></script>
</body>

</html>

<?php
//Checking

if (isset($_POST['submit'])) {
    //Process For Login

    //1. Get the Data from Login Form
    $username = mysqli_real_escape_string($conn,$_POST['username']);

    $raw_password= md5($_POST['password']);
    $password = mysqli_real_escape_string($conn,$raw_password);
    
    //2. SQL Checking

    $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

    //3. Execute Query

    $res = mysqli_query($conn , $sql);

    //4. Count rows to check

    $count = mysqli_num_rows($res);

    if($count==1)
    {
        $_SESSION['login'] = "<div class='success'> Login Successfully. </div>";
        $_SESSION['user'] = $username; //To Check whether the user is Logged In or Not
        header('location:'.SITEURL.'admin/');
    }
    else
    {
        $_SESSION['login'] = "<div class='error'> Username and Password did not match. </div>";
        header('location:'.SITEURL.'admin/3/login.php');
    }
}
?>