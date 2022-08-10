<?php include('main-partial/menu.php'); ?>

    <!-- Item sEARCH Section Starts Here -->
    <section class="item-search text-center">
        <div class="container">

            <?php
                $search= mysqli_real_escape_string($conn,$_POST['search']);
            ?>

            <h2>Items on Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>
    <!-- Item sEARCH Section Ends Here -->



    <!-- Item MEnu Section Starts Here -->
    <section class="item-menu">
        <div class="container">

            <h2 class="text-center">Item Menu</h2>

            <?php

                $sql = "SELECT * FROM tbl_items WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                if($count>0)
                {
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
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
                                                <img src="<?php echo SITEURL; ?>images/item/<?php echo $image_name; ?>" alt="Item" class="img-responsive img-curve">
                                            <?php
                                        }
                                    ?>
                                </div>

                                <div class="item-menu-desc">
                                    <h4><?php echo $title;?></h4>
                                    <p class="item-price">₱<?php echo $price;?></p>
                                    <p class="item-detail">
                                        <?php echo $description; ?>
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
                    echo "<div class='error'>Item not Found.</div>";
                }

            ?>

            <div class="clearfix"></div>

        </div>

    </section>
    <!-- Item Menu Section Ends Here -->

<?php include('main-partial/footer.php'); ?>
