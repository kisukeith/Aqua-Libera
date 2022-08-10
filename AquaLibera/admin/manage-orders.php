<?php include('partials/menu.php'); ?>
<!--Main Content-->
<div class="main-content">
    <div class="wrapper">
        <h2>Manage Orders</h2>

        <?php
            if (isset($_SESSION['update']))
            {
                echo $_SESSION['update']; //Display
                unset($_SESSION['update']); //Remove Message
            }
        ?>

        <br/><br/><br/>

        <table class="tbl-full">
            <tr>
                <th>ID</th>
                <th>Item</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Custumer Name</th>
                <th>Contact No.</th>
                <th>Email</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>

            <?php
                $sql = "SELECT * FROM tbl_order ORDER BY id DESC";

                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                $sn=1;

                if($count>0)
                {
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $item = $row['item'];
                        $price = $row['price'];
                        $qty = $row['qty'];
                        $total = $row['total'];
                        $order_date = $row['order_date'];
                        $status = $row['status'];
                        $customer_name = $row['customer_name'];
                        $customer_contact = $row['customer_contact'];
                        $customer_email = $row['customer_email'];
                        $customer_address = $row['customer_address'];

                        ?>
                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $item; ?></td>
                                <td><?php echo $price; ?></td>
                                <td><?php echo $qty; ?></td>
                                <td>₱<?php echo $total; ?></td>
                                <td><?php echo $order_date; ?></td>
                                <td>
                                    <?php 
                                        if($status=="Ordered")
                                        {
                                            echo "<label>$status</label>";
                                        }
                                        elseif($status=="On Delivery")
                                        {
                                            echo "<label style='color: orange;'>$status</label>";
                                        }
                                        elseif($status=="Delivered")
                                        {
                                            echo "<label style='color: green;'>$status</label>";
                                        }
                                        elseif($status=="Cancelled")
                                        {
                                            echo "<label style='color: red;'>$status</label>";
                                        }
                                    ?>
                                </td>
                                <td><?php echo $customer_name; ?></td>
                                <td><?php echo $customer_contact; ?></td>
                                <td><?php echo $customer_email; ?></td>
                                <td><?php echo $customer_address; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-update">Update Order</a>
                                </td>
                            </tr>
                        <?php
                    }
                }
                else
                {
                    echo "<tr><td colspan='12' class='error'> Orders no Available</td></tr>";
                }
            ?>

        </table>
    </div>
</div>
<!--End-->
<?php include('partials/footer.php'); ?>