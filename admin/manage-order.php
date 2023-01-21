<!-- Menu goes here -->
<?php include 'partials/menu.php' ?>

    <div class="order container">
        <div class="wrapper">
            
        <h1 class="heading"><i class="fas fa-arrow-circle-up me-3"></i>Food Orders</h1>


        <table class="admin-table order">

                <thead>
                    <tr>
                        <th>S.N</th>
                        <th>Food</th>
                        <th style="text-align: center;">Price</th>
                        <th style="text-align: center;">Quantity</th>
                        <th style="text-align: center;">Total</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Address</th>
                    </tr>
                </thead>

                <tbody>
                    <?php

                        $query = "SELECT * FROM `order` ORDER BY id DESC";

                        $res = mysqli_query($con, $query);

                        //$res = mysqli_fetch_array($query);

                        
                        if($res == true)
                        {
                            $count = mysqli_num_rows($res);
                            
                            if($count >  0)
                            {
                                $sn = 1;
                                $row = mysqli_fetch_assoc($res);

                                while($row)
                                {
                                    ?>
                                        <tr>
                                            <td data-label="S.N"><?php echo $sn++ ?></td>
                                            <td data-label="Food" class="fname"><?php echo $row['food'] ?></td>
                                            <td data-label="Price" style="text-align: center;"><i class="fas fa-inr me-3"></i><?php echo $row['price'] ?></td>
                                            <td data-label="Quantity" style="text-align: center;"><?php echo $row['qty'] ?></td>
                                            <td data-label="Total" style="text-align: center;"><i class="fas fa-inr me-3"></i><?php echo $row['total'] ?></td>
                                            <td data-label="Order Date"><?php echo $row['order_date'] ?></td>
                                            <td data-label="Status"><?php echo $row['status'] ?></td>
                                            <td data-label="Name"><?php echo $row['customer_name'] ?></td>
                                            <td data-label="Contact"><?php echo $row['customer_contact'] ?></td>
                                            <td data-label="Email"><?php echo $row['customer_email'] ?></td>
                                            <td data-label="Address"><?php echo $row['customer_address'] ?></td>
                                            <!-- <td data-label="Actions" class="op">
                                                <a class="icon" href=<?php echo SITEURL . "/admin/update-order.php?id=". $row['id']; ?> >
                                                    <i class="fas fa-pencil"></i>
                                                </a>
                                            </td> -->
                                        </tr>
                                    <?php
                                    $row = mysqli_fetch_assoc($res); 
                                }
                            }
                            else
                            {
                                ?>
                                        
                                <tr>
                                    <td colspan="4" style="text-align: center;"> No Data Found !!</td>
                                </tr>

                                <?php
                            }
                        }
                    ?>

                </tbody>

            </table>
        </div>
    </div>

<!-- Footer goes here -->
<?php include 'partials/footer.php' ?>