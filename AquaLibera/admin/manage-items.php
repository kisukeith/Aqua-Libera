<?php include('partials/menu.php'); ?>
<!--Main Content-->
<div class="main-content">
    <div class="wrapper">
        <h2>Manage Items</h2>
        <br /><br />

        <?php
            if (isset($_SESSION['add']))
            {
                echo $_SESSION['add']; //Display
                unset($_SESSION['add']); //Remove Message
            }
            if (isset($_SESSION['remove']))
            {
                echo $_SESSION['remove']; //Display
                unset($_SESSION['remove']); //Remove Message
            }
            if (isset($_SESSION['delete']))
            {
                echo $_SESSION['delete']; //Display
                unset($_SESSION['delete']); //Remove Message
            }
            if (isset($_SESSION['delete-item']))
            {
                echo $_SESSION['delete-item']; //Display
                unset($_SESSION['delete-item']); //Remove Message
            }
            if (isset($_SESSION['no-item-found']))
            {
                echo $_SESSION['no-item-found']; //Display
                unset($_SESSION['no-item-found']); //Remove Message
            }
            if (isset($_SESSION['upload']))
            {
                echo $_SESSION['upload']; //Display
                unset($_SESSION['upload']); //Remove Message
            }
            if (isset($_SESSION['failed-remove']))
            {
                echo $_SESSION['failed-remove'];
                unset($_SESSION['failed-remove']);
            }
            if (isset($_SESSION['update']))
            {
                echo $_SESSION['update']; //Display
                unset($_SESSION['update']); //Remove Message
            }
        ?>
        <br><br>
        <!-- Button to Add Admins -->
        <a href="<?php echo SITEURL;?>admin/add-items.php" class="btn-primary">Add Item</a>
        <!-- End -->

        <br /><br />

        <table class="tr-items">
            <tr>
                <th>I.N</th>
                <th>Title</th>
                <th>Description</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php
                $sql = "SELECT * FROM tbl_items";

                $sql2 = "SELECT * FROM tbl_categories";

                $res = mysqli_query($conn , $sql);

                $res2 = mysqli_query($conn , $sql2);

                $count = mysqli_num_rows($res);

                $count2 = mysqli_num_rows($res2);

                $sn=1;

                if($count>0)
                {
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $title = $row['title'];
                        $description = $row['description'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];

                        ?>

                        <tr>
                            <td><?php echo $sn++;?></td>
                            <td><?php echo $title;?></td>
                            <td class="desc-30"><?php echo $description;?></td>
                            <td>₱<?php echo $price;?></td>
                            <td>
                                <?php
                                    if($image_name=="")
                                    {
                                        echo "<div class='error'>No Image Added.</div>";
                                    }
                                    else
                                    {
                                        ?>
                                        <img src="<?php echo SITEURL;?>images/item/<?php echo $image_name;?>" width="80px">
                                        <?php
                                    }
                                ?>
                            </td>
                            <td><?php echo $featured;?></td>
                            <td><?php echo $active;?></td>
                            <td>
                                <a href="<?php echo SITEURL;?>admin/update-items.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class="btn-update">Update Item</a>
                                <a href="<?php echo SITEURL;?>admin/delete-items.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class="btn-delete">Delete Item</a>
                            </td>
                        </tr>
                        <?php
                    }
                }
                else
                {
                    echo "<tr><td colspan='7' class='error'> Item not Added Yet. </td></tr>";
                }
            ?>

        </table>
    </div>
</div>
<!--End-->
<?php include('partials/footer.php'); ?>