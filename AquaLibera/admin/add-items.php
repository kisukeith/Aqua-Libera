<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h2>Add Items</h2>
        <br>

        <?php
            if (isset($_SESSION['upload']))
            {
                echo $_SESSION['upload']; //Display
                unset($_SESSION['upload']); //Remove Message
            }
        ?>

        <br>
        <form action="#" method="POST" enctype="multipart/form-data">

            <table class="tbl-40">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the Item">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td><textarea name="description" cols="30" rows="5" placeholder="Item Description" maxlength="255"></textarea></td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>₱ <input type="number" name="price"></td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td><input type="file" name="image"></td>
                </tr>

                <!--CATEGORY START-->
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">

                            <?php
                                $sql = "SELECT * FROM tbl_categories WHERE active='Yes'";
                                $res = mysqli_query($conn , $sql);
                                $count = mysqli_num_rows($res);

                                if($count>0)
                                {
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        $id = $row['id'];
                                        $title =$row['title'];
                                        ?>

                                        <option value="<?php echo $id;?>"><?php echo $title;?></option>
                                        <?php
                                    }
                                }
                                else
                                {
                                    ?>
                                    <option value="0">No Category Found</option>
                                    <?php
                                }
                            ?>

                        </select>
                    </td>
                </tr>
                <!--CATEGORY END-->

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
                        <br/><br/>
                        <input type="submit" name="submit" value="Add Item" class="btn-primary">
                    </td>
                </tr>

            </table>

        </form>

        <?php

            if(isset($_POST['submit']))
            {
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];


                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];
                }
                else
                {
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

                //2. Upload Image

                if(isset($_FILES['image']['name']))
                {
                    $image_name = $_FILES['image']['name'];

                    if($image_name!="")
                    {
                        $ext = end(explode('.' , $image_name));

                        $image_name = "WaterStation_Item_".rand(0000, 9999).'.'.$ext;

                        $src = $_FILES['image']['tmp_name'];

                        $dst = "../images/item/".$image_name;

                        //Uploading the Image

                        $upload = move_uploaded_file($src , $dst);

                        //Checking
                        if($upload==FALSE)
                        {
                            $_SESSION['upload'] = "<div class='error'> Failed to Upload Image. </div>";
                            header('location:'.SITEURL.'admin/add-items.php');
                            die();
                        }
                    }
                }
                else
                {
                    $image_name = "";
                }

                //3. Insert into database

                $sql2 = "INSERT INTO tbl_items SET
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = $category,
                    featured = '$featured',
                    active = '$active'
                ";

                //3.Execute Query

                $res2 = mysqli_query($conn , $sql2);

                //4. Check whether Query is Executed

                if($res2==TRUE)
                {
                    //Query is Executed
                    $_SESSION['add'] = "<div class='success'> Item Added Successfully. </div>";
                    header('location:'.SITEURL.'admin/manage-items.php');
                }
                else
                {
                    //Failed to Execute
                    $_SESSION['add'] = "<div class='error'> Failed to Add the Item. </div>";
                    header('location:'.SITEURL.'admin/add-items.php');
                }
            }
        ?>
    </div>
</div>

<?php include('partials/footer.php');?>

