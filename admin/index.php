<!-- Menu goes here -->
<?php include 'partials/menu.php' ?>

    <div class="home main-content container">
        <div class="wrapper">

            <?php

                if(isset($_SESSION['login-admin']))
                {
                    echo $_SESSION['login-admin'];
                    // It should not display after reloading the page.
                    unset($_SESSION['login-admin']);
                }

                $query = "SELECT * FROM category";
                $query2 = "SELECT * FROM food";
                $query3 = "SELECT * FROM `order`";
                $query4 = "SELECT sum(total) AS Total FROM `order`";

                $res = mysqli_query($con, $query);
                $res2 = mysqli_query($con, $query2);
                $res3 = mysqli_query($con, $query3);
                $res4 = mysqli_query($con, $query4);

                $count = mysqli_num_rows($res) ? mysqli_num_rows($res) : 0;
                $count2 = mysqli_num_rows($res2) ? mysqli_num_rows($res2) : 0;
                $count3 = mysqli_num_rows($res3) ? mysqli_num_rows($res3) : 0;

                $row = mysqli_fetch_assoc($res4);

                $revenue = $row['Total'];

            ?>
            
        <h1 class="heading"><i class="fas fa-th-large me-3"></i>DashBoard</h1>

        <div class="card-container">
            <div class="card">
                <img src="../images/d-1.png" alt="">
                <div class="count"><?php echo $count  ?></div>
                <h1>Categories</h1>
            </div>
            <div class="card">
                <img src="../images/d-2.png" class="sm" alt="">
                <div class="count"><?php echo $count2  ?></div>
                <h1>Foods</h1>
            </div>
            <div class="card">
                <img src="../images/d-3.png" alt="">
                <div class="count"><?php echo $count3  ?></div>
                <h1>Orders</h1>
            </div>
            <div class="card">
                <img src="../images/d-4.png" alt="">
                <div class="count"><i class="fas fa-inr me-3"></i><?php echo $revenue ?></div>
                <h1>Revenues</h1>
            </div>
        </div>

        <div class="highlight">
            <img src="../images/main-logo.png" alt="">
            <h1><i class="fas fa-diamond me-3"></i>CpTech Family</h1>
        </div>
        </div>

    </div>

<!-- Footer goes here -->
<?php include 'partials/footer.php' ?>

