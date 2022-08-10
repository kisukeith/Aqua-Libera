<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h2>Add Category</h2>
        <br>

        <?php
            if(isset($_SESSION['add']))
            {
                echo$_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['upload']))
            {
                echo$_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>
        <br>

        <!--Add Category Form Start -->

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-40">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>

                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-primary">
                    </td>
                </tr>
            </table>
        </form>
        <br>
        <!--Add Category Form End -->

        <!--Back-end Code Start -->
        <?php
            //Checking if Checked

            if(isset($_POST['submit']))
            {
                //echo "Clicked";

                //1. Getting the value from the Form
                $title = $_POST['title'];
                
                //For Radio Input Type
                if(isset($_POST['featured']))
                {
                    //Get the Value
                    $featured = $_POST['featured'];
                }
                else
                {
                    //Set the Default Value
                    $featured = "No";
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No";
                }
                
                //Check whether image is selected or not
                //print_r($_FILES['image']);
                
                //die(); //Break the Code

                if(isset($_FILES['image']['name']))
                {
                    //Upload the Image
                    
                    $image_name = $_FILES['image']['name'];

                    //Renaming Image
                    if($image_name != "")
                    {

                        $ext = end(explode('.' , $image_name));

                        $image_name = "WaterStation_Category_".rand(000, 999).'.'.$ext;

                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/category/".$image_name;

                        //Uploading the Image

                        $upload = move_uploaded_file($source_path , $destination_path);

                        //Checking
                        if($upload==FALSE)
                        {
                            $_SESSION['upload'] = "<div class='error'> Failed to Upload Image. </div>";
                            header('location:'.SITEURL.'admin/add-categories.php');
                            die();
                        }
                    }   
                }
                else
                {
                    //Don't Upload Image and set the image name value as blank
                    $image_name = "";
                }

                //2. Create SQL Query to insert into Database
                
                $sql = "INSERT INTO tbl_categories SET
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active'
                ";

                //3.Execute Query

                $res = mysqli_query($conn , $sql);

                //4. Check whether Query is Executed

                if($res==TRUE)
                {
                    //Query is Executed
                    $_SESSION['add'] = "<div class='success'> Category Added Successfully. </div>";
                    header('location:'.SITEURL.'admin/manage-categories.php');
                }
                else
                {
                    //Failed to Execute
                    $_SESSION['add'] = "<div class='error'> Failed to Add Category. </div>";
                    header('location:'.SITEURL.'admin/add-categories.php');
                }
            }
        ?>
        <!--Back-end Code End -->
    </div>
</div>

<?php include('partials/footer.php'); ?>