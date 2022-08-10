<?php include('partials/menu.php'); ?>
<!--Main Content-->
<div class="main-content">
    <div class="wrapper">
        <h2><strong>DASHBOARD</strong></h2>
        <br>

        <?php
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login']; //Display
            unset($_SESSION['login']); //Remove Message
        }
        ?>

        <br>

        <div class="col-4 text-center">

            <?php
                $sql4 = "SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered'";

                $res4 = mysqli_query($conn, $sql4);

                $row4 = mysqli_fetch_assoc($res4);

                $total_revenue = $row4['Total'];
            ?>
            <h1>₱<?php echo $total_revenue; ?>.00</h1>
            <br />
            Revenue Generated
        </div>

        <div class="col-4 text-center">

            <?php
                $sql3 = "SELECT * FROM tbl_order";

                $res3 = mysqli_query($conn, $sql3);

                $count3 = mysqli_num_rows($res3);
            ?>
            <h1><?php echo $count3; ?></h1>
            <br />
            Orders
        </div>

        <div class="col-4 text-center">

            <?php
                $sql2 = "SELECT * FROM tbl_items";

                $res2 = mysqli_query($conn, $sql2);

                $count2 = mysqli_num_rows($res2);
            ?>
            <h1><?php echo $count2; ?></h1>
            <br />
            Items
        </div>

        <div class="col-4 text-center">

            <?php
                $sql = "SELECT * FROM tbl_categories";

                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);
            ?>
            <h1><?php echo $count; ?></h1>
            <br />
            Water Stations
        </div>

        <div class="clearfix"></div>

    </div>
</div>
<!--End-->
<?php include('partials/footer.php'); ?>