<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h2>Update Category</h2>
        <br>

        <?php

        if (isset($_GET['id'])) {
            //1. Get Id of the Category
            $id = $_GET['id'];

            //2. Create Sql Query
            $sql = "SELECT * FROM tbl_categories WHERE id=$id";

            //Execute Query
            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);

            //Checking

            if ($count == 1) {
                //echo 'Category Available';
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $current_image = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];
            } else {
                $_SESSION['no-category-found'] = "<div class='error'> Category Not Found </div>";
                header('location:' . SITEURL . 'admin/manage-categories.php');
            }
        } else {
            header('location:' . SITEURL . 'admin/manage-categories.php');
        }

        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-40">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>

                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                        if ($current_image != "") {
                        ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="100px">
                        <?php
                        } else {
                            echo "<div class='error'> Image not Added </div>";
                        }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if ($featured == "Yes") {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="Yes"> Yes
                        <input <?php if ($featured == "No") {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if ($active == "Yes") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="Yes"> Yes
                        <input <?php if ($active == "No") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-primary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        //Checking whether the Update Button is Clicked

        if (isset($_POST['submit'])) {
            //echo "Button Clicked";
            //Getting the Values
            $id = $_POST['id'];
            $title = $_POST['title'];
            $current_image = $_POST['current_image'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            //Updating the new image

            if (isset($_FILES['image']['name']))
            {

                $image_name = $_FILES['image']['name'];

                if ($image_name != "")
                {
                    //Upload
                    $ext = end(explode('.', $image_name));

                    $image_name = "WaterStation_Category_" . rand(000, 999) . '.' . $ext;

                    $source_path = $_FILES['image']['tmp_name'];

                    $destination_path = "../images/category/" . $image_name;

                    //Uploading the Image

                    $upload = move_uploaded_file($source_path, $destination_path);

                    //Checking
                    if ($upload == FALSE) {
                        $_SESSION['upload'] = "<div class='error'> Failed to Upload Image. </div>";
                        header('location:' . SITEURL . 'admin/manage-categories.php');
                        die();
                    }

                    //Removing Current Image
                    if ($current_image != "") {
                        $remove_path = "../images/category/" . $current_image;

                        $remove = unlink($remove_path);

                        if ($remove == FALSE) {
                            $_SESSION['failed-remove'] = "<div class='error'> Failed to Remove Current Image. </div>";
                            header('location:' . SITEURL . 'admin/manage-categories.php');
                            die();
                        }
                    }
                }
                else
                {
                    $image_name = $current_image;
                }
            }
            else
            {
                $image_name = $current_image;
            }

            //Update the Database

            $sql2 = "UPDATE tbl_categories SET
                title = '$title',
                image_name = '$image_name',
                featured = '$featured',
                active = '$active'
                WHERE id=$id
            ";

            //Execute Query

            $res2 = mysqli_query($conn, $sql2);

            if ($res2 == TRUE) {
                $_SESSION['update'] = "<div class='success'> Category Updated Succesfully. </div>";
                header('location:' . SITEURL . 'admin/manage-categories.php');
            } else {
                $_SESSION['update'] = "<div class='error'> Failed to Update Category. </div>";
                header('location:' . SITEURL . 'admin/manage-categories.php');
            }
        }
        ?>

    </div>
</div>

<?php include('partials/footer.php') ?>