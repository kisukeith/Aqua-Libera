<?php include('partials/menu.php') ?>

<?php

if (isset($_GET['id'])) {
    //1. Get Id of the Category
    $id = $_GET['id'];

    //2. Create Sql Query
    $sql2 = "SELECT * FROM tbl_items WHERE id=$id";

    //Execute Query
    $res2 = mysqli_query($conn, $sql2);

    $row2 = mysqli_fetch_assoc($res2);
    $title = $row2['title'];
    $description = $row2['description'];
    $current_image = $row2['image_name'];
    $current_category = $row2['category_id'];
    $price = $row2['price'];
    $featured = $row2['featured'];
    $active = $row2['active'];
} else {
    header('location:' . SITEURL . 'admin/manage-items.php');
}
?>

<div class="main-content">
    <div class="wrapper">
        <h2>Update Items</h2>
        <br>
        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-40">
                <!--TITLE-->
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>" placeholder="Item Title goes here.">
                    </td>
                </tr>

                <!--Description-->
                <tr>
                    <td>Description: </td>
                    <td><textarea name="description" cols="30" rows="5" maxlength="255"><?php echo $description; ?></textarea></td>
                </tr>

                <!--Price-->
                <tr>
                    <td>Price: </td>
                    <td>₱ <input type="number" name="price" value="<?php echo $price; ?>"></td>
                </tr>

                <!--Current Image-->
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                        if ($current_image != "") {
                        ?>
                            <img src="<?php echo SITEURL; ?>images/item/<?php echo $current_image; ?>" width="100px">
                        <?php
                        } else {
                            echo "<div class='error'> Image not Added </div>";
                        }
                        ?>
                    </td>
                </tr>

                <!--New Image-->
                <tr>
                    <td>New Image: </td>
                    <td><input type="file" name="image"></td>
                </tr>

                <!--CATEGORY START-->
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
                            <?php
                            $sql = "SELECT * FROM tbl_categories WHERE active='Yes'";
                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);

                            if ($count > 0) {
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $category_title = $row['title'];
                                    $category_id = $row['id'];
                            ?>
                                    <option <?php if ($current_category == $category_id) {
                                                echo "selected";
                                            } ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                <?php
                                }
                            } else {
                                ?>
                                <option value="0">No Category Found</option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <!--CATEGORY END-->

                <!--Featured-->
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
                <!--Active-->
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
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="submit" name="submit" value="Update Item" class="btn-primary">
                    </td>
                </tr>
            </table>
        </form>

        <?php

        if (isset($_POST['submit'])) {
            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $current_image = $_POST['current_image'];
            $category = $_POST['category'];

            $featured = $_POST['featured'];
            $active = $_POST['active'];

            if (isset($_FILES['image']['name'])) {

                $image_name = $_FILES['image']['name'];

                if ($image_name != "") {
                    //Upload

                    $arrayVar = explode(".", $image_name);

                    $ext = end($arrayVar);

                    $image_name = "WaterStation_Category_" . rand(0000, 9999) . '.' . $ext;

                    $src_path = $_FILES['image']['tmp_name'];

                    $dtn_path = "../images/item/" . $image_name;

                    //Uploading the Image

                    $upload = move_uploaded_file($src_path, $dtn_path);

                    //Checking
                    if ($upload == FALSE) {
                        $_SESSION['upload'] = "<div class='error'> Failed to Upload Image. </div>";
                        header('location:' . SITEURL . 'admin/manage-items.php');
                        die();
                    }

                    //Removing Current Image
                    if ($current_image != "") {
                        $remove_path = "../images/item/" . $current_image;

                        $remove = unlink($remove_path);

                        if ($remove == FALSE) {
                            $_SESSION['failed-remove'] = "<div class='error'> Failed to Remove Current Image. </div>";
                            header('location:' . SITEURL . 'admin/manage-items.php');
                            die();
                        }
                    }
                }else
                {
                    $image_name = $current_image;
                }
            } else {
                $image_name = $current_image;
            }

            //Update the Database

            $sql3 = "UPDATE tbl_items SET
                title = '$title',
                description = '$description',
                price = $price,
                image_name = '$image_name',
                category_id = '$category',
                featured = '$featured',
                active = '$active'
                WHERE id=$id
            ";

            //Execute Query

            $res3 = mysqli_query($conn, $sql3);

            if ($res3 == TRUE) {
                $_SESSION['update'] = "<div class='success'> Item Updated Succesfully. </div>";
                header('location:' . SITEURL . 'admin/manage-items.php');
            } else {
                $_SESSION['update'] = "<div class='error'> Failed to Update the Item. </div>";
                header('location:' . SITEURL . 'admin/manage-items.php');
            }
        }
        ?>
    </div>
</div>

<?php include('partials/footer.php') ?>