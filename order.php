<!-- Include Header -->
<?php include "header.php" ?>

<section class="comman-hero order">

    <div class="content">

        <h2>
            FILL BELOW <span>FO</span>RM TO CONFIRM YOUR <span>OR</span>DER
        </h2>

        <p>
            Grap the secure , trustable and honest services provided my cptech family...
        </p>
    </div>
</section>

<?php

    if(isset($_GET['food_id']))
    {
        $food_id = $_GET['food_id'];

        // 1. Create query

        $query = "SELECT * FROM food WHERE id = $food_id";

        // 2. Execute query

        $res = mysqli_query($con, $query);

        if($res == true)
        {
            // 3. Count rows

            $count = mysqli_num_rows($res);

            if($count == 1)
            {
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $price = $row['price'];
                $image_name = $row['image_name'];
            }
            else
            {
                $url = SITEURL;
                echo "<script> window.location.href = '$url'</script>";
            }
        }
        else
        {
            $url = SITEURL;
            echo "<script> window.location.href = '$url'</script>";
        }
    }
?>

<section class="order-alt">
    <form action="" method="POST">

        <h1><i class="fas fa-arrow-circle-up me-4"></i>Make Your Order</h1>

        <small class="msg primarymsg fw"><i class="fas fa-arrow-circle-down me-3"></i>Selected Food</small>
        <div class="food">
            <div class="image">
                <?php

                    if($image_name != "")
                    {
                        ?>
                            <img src="<?php echo SITEURL . "/images/Foods/" . $image_name ?>" alt="$image_name">
                        <?php
                    }
                    else
                    {
                        echo "<div class='msg warningmsg fw'><i class='fas fa-exclamation-circle me-2'></i>Image is not Available !!</div>";
                    }
                ?>
            </div>
            <div class="content">
                <div class="title"><?php echo $title ?></div>
                <input type="hidden" name="food"  value="<?php echo $title ?>">
                <div class="price"><i class="fas fa-inr me-3"></i><?php echo $price ?></div>
                <input type="hidden" name="price" value="<?php echo $price ?>">
                <label for="qty" class="qty">Quantity</label>
                <input type="number" name="qty" id="qty" placeholder="Qty" required>
            </div>
        </div>

        <div class="input-box">
            <label for="name">Full Name</label>
            <input type="text" name="full_name" id="name" placeholder="Enter your name">
        </div>

        <div class="input-box">
            <label for="phone">Phone Number</label>
            <input type="number" name="phone_number" id="phone" placeholder="Enter your phone">
        </div>

        <div class="input-box">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Enter your email">
        </div>

        <div class="input-box">
            <label for="address">Address</label>
            <textarea name="address" id="address" cols="30" rows="5" placeholder="Enter your address"></textarea>
        </div>

        <input type="submit" name="submit" value="Order" class="d-btn">

    </form>
    <div class="image">
        <img src="images/order-form.png" alt="order">
    </div>
</section>

<!-- When form is submitted -->

<?php

    if(isset($_POST['submit']))
    {
        $food = $_POST['food'];
        $price = $_POST['price'];
        $qty = $_POST['qty'];
        $total = $qty * $price; // price x quantity = total
        $order_date = date("y-m-d h:i:sa");
        $status = "Ordered";  // Ordered, On delivery, Delivered, Cancelled
        $customer_name = $_POST['full_name'];
        $customer_contact = $_POST['phone_number'];
        $customer_email = $_POST['email'];
        $customer_address = $_POST['address'];

        // 1. Create a query to insert data

        // $query2 = 
        // "
        //     INSERT INTO order (food , price, qty, total, order_date, status, customer_name, customer_contact, customer_email, customer_address)
        //     VALUES
        //     ('$food', $price, $qty, $total, '$order_date', '$status', '$customer_name', '$customer_contact', '$customer_email', '$customer_address');
        // ";

        $query2 = 
        "
            INSERT INTO `order` SET
            food = '$food',
            price = $price,
            qty =  $qty,
            total = $total,
            order_date = '$order_date',
            status = '$status',
            customer_name = '$customer_name',
            customer_contact = '$customer_contact',
            customer_email = '$customer_email',
            customer_address = '$customer_address'
        ";

        // 2. Execute Query

        $res2 = mysqli_query($con, $query2);

        if($res2 == true)    
        {
            // Add data to session variable.
            $_SESSION['order'] = "<div class='msg successmsg center m-auto'><i class='fas fa-check-circle me-2'></i>Food Ordered Successfully !!</div>";

            // Redirect to manage admin page.
            $url = SITEURL . "/category.php";
            echo "<script> window.location.href = '$url'</script>";
        }
        else
        {
            // Add Data to session variable.
            $_SESSION['order'] = "<div class='msg errormsg center m-auto'><i class='fas fa-times-circle me-2'></i>Failed Order Food !!</div>";

            // Redirect to manage admin page.
            $url = SITEURL . "/category.php";
            echo "<script> window.location.href = '$url'</script>";
        }
    }

?>

<!-- Include Footer -->
<?php include "footer.php" ?>