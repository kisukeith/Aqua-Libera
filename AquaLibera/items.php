<?php include('main-partial/menu.php'); ?>

    <!-- Items SEARCH Section Start -->
    <section class="item-search text-center">
        <div class="container">

            <form action="<?php echo SITEURL; ?>item-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Items..." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- Items SEARCH Section End -->


    <!-- Item Menu Section Starts Here -->
    <section class="item-menu">
        <div class="container">
            <h2 class="text-center">Item Menu</h2>

            <br>

            <?php
            
            $sql = "SELECT * FROM tbl_items WHERE active='Yes'";

            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);

            if($count>0)
            {
                while($row=mysqli_fetch_assoc($res))
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
                                    <img src="<?php echo SITEURL;?>images/item/<?php echo $image_name;?>" alt="item" class="img-responsive img-curve">
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

    </section>
    <!-- Item Menu Section Ends Here -->

<?php include('main-partial/footer.php'); ?>