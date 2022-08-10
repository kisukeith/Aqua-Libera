<?php include('main-partial/menu.php'); ?>

<?php
    if(isset($_GET['category_id']))
    {
        $category_id = $_GET['category_id'];

        $sql = "SELECT title FROM tbl_categories WHERE id=$category_id";

        $res = mysqli_query($conn, $sql);

        $row = mysqli_fetch_assoc($res);

        $category_title = $row['title'];
    }
    else
    {
        header('location:'.SITEURL);
    }
?>

    <!-- Item sEARCH Section Starts Here -->
    <section class="item-search text-center">
        <div class="container">

            <h2>Items on <a href="#" class="text-white">"<?php echo $category_title?>"</a></h2>

        </div>
    </section>
    <!-- Item sEARCH Section Ends Here -->

    <!-- Item MEnu Section Starts Here -->
    <section class="item-menu">
        <div class="container">
            <h2 class="text-center">Item Menu</h2>

            <?php
                $sql2 = "SELECT * FROM tbl_items WHERE category_id=$category_id";

                $res2 = mysqli_query($conn, $sql2);

                $count2 = mysqli_num_rows($res2);

                if($count2>0)
                {
                    while($row2=mysqli_fetch_assoc($res2))
                    {
                        $id = $row2['id'];
                        $title = $row2['title'];
                        $description = $row2['description'];
                        $price = $row2 ['price'];
                        $image_name = $row2['image_name'];
                        ?>
                            <div class="item-menu-box">
                                <div class="item-menu-img">

                                    <?php
                                        if($image_name=="")
                                        {
                                            echo "<div class='error'>Image not Available.</div>";
                                        }
                                        else
                                        {
                                            ?>
                                                <img src="<?php echo SITEURL; ?>images/item/<?php echo $image_name; ?>" alt="Items" class="img-responsive img-curve">
                                            <?php
                                        }
                                    ?>
                                </div>

                                <div class="item-menu-desc">
                                    <h4><?php echo $title;?></h4>
                                    <p class="item-price">₱<?php echo $price;?></p>
                                    <p class="item-detail">
                                        <?php echo $description;?>
                                    </p>
                                    <br>

                                    <a href="<?php echo SITEURL;?>order.php?item_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>
                        <?php
                    }
                }
                else
                {   
                    echo "<div class='error item-menu-box text-center'>There are no Items Available.</div>";
                }
            ?>

            <div class="clearfix"></div>

        </div>

    </section>
    <!-- Item Menu Section Ends Here -->

<?php include('main-partial/footer.php'); ?>
