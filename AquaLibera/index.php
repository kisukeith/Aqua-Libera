<?php include('main-partial/menu.php'); ?>

    <!-- Items SEARCH Section Start -->
    <section class="item-search text-center">
        <div class="container">

            <form action="<?php echo SITEURL; ?>item-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Water Stations..." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- Items SEARCH Section End -->

    <?php
        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
    ?>

    <!-- Categories Section Start -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Water Stations</h2>

            <?php
                $sql = "SELECT * FROM tbl_categories WHERE active='Yes' AND featured='Yes' LIMIT 3";

                $res =mysqli_query($conn , $sql);

                $count = mysqli_num_rows($res);

                if($count>0)
                {
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>
                        <a href="<?php echo SITEURL;?>category-items.php?category_id=<?php echo $id; ?>">
                            <div class="box-3">
                                <div class="float-container">
                                    <?php
                                        if($image_name=="")
                                        {
                                            echo "<div class='error'>Image not Available.</div>";
                                        }
                                        else
                                        {
                                            ?>
                                            <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name;?>" alt="AquaBest" class="img-responsive img-curve">
                                            <h3 class="float-text text-black"><?php echo $title; ?></h3>
                                            <?php
                                        }
                                    ?>
                                </div>
                            </div>
                        </a>
                        <?php
                    }
                }
                else
                {
                    echo "<div class='error'>No Categories Found or Added.</div>";
                }
            ?>
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section End-->

    <!-- Item Menu Section Start-->
    <section class="item-menu">
        <div class="container">
            <h2 class="text-center">Item Menu</h2>

            <?php
            
            $sql2 = "SELECT * FROM tbl_items WHERE active='Yes' AND featured='Yes' LIMIT 6";

            $res2 = mysqli_query($conn, $sql2);

            $count2 = mysqli_num_rows($res2);

            if($count2>0)
            {
                while($row=mysqli_fetch_assoc($res2))
                {
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row ['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
                    ?>

                    <div class="item-menu-box">
                        <div class="item-menu-img">
                            <?php
                                if($image_name=="")
                                {
                                    echo "<div class='error'>Image isn't Available.</div>";
                                }
                                else
                                {
                                    ?>
                                    <img src="<?php echo SITEURL;?>images/item/<?php echo $image_name;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
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
                echo "<div class='error'>Item not Available.</div>";
            }
            ?>

            <div class="clearfix"></div>

            <p class="text-center">
            <a href="<?php echo SITEURL;?>items.php">See All Items</a>
            </p>
        </div>

    </section>
    <!-- Item Menu Section End-->

<?php include('main-partial/footer.php'); ?>