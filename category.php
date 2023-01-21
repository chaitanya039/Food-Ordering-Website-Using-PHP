<!-- Include Header -->

<?php 
    
    include 'header.php';
?>

<section class="hero">
    <h1>The Best Restaurants in Your Home</h1>
</section>

<section class="category">

        <div class="heading-container">
            <div class="sub-title">different kind of</div>
            <div class="title">Categories</div>
            <div class="bottom-dots">
                <span class="dot line-dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
            </div>
        </div>

        
        <?php

        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];

            unset($_SESSION['order']);
        }

        ?>

        <div class="card-container">

        <?php

            // 1. Create query to fetch data from category.
            $query = "SELECT * FROM category";

            // 2. Execute the Query.
            $res = mysqli_query($con, $query);

            if($res == true)
            {
                // 3. If res is true then count number of rows.
                $count = mysqli_num_rows($res);

                // 4. Means we found some rows.
                if($count > 0)
                {
                    while($row = mysqli_fetch_assoc($res))
                    {
                        ?>
                            <a href="<?php echo SITEURL . "/category_food.php?category_id=" . $row['id']; ?>" class="card">
                                <div class="image">
                                    
                                <?php
                                    if($row['image_name'] != "")
                                    {
                                        ?>
                                        <img src="<?php 
                                        echo SITEURL . "/images/category/" . $row['image_name'];
                                        ?>" alt="">
                                        <?php
                                    }
                                    else
                                    {
                                        echo "<div class='msg warningmsg fw'><i class='fas fa-exclamation-circle me-2'></i>Image is not Available !!</div>";
                                    }
                                ?>

                                </div>
                                <div class="status">
                                    <?php

                                    if($row['featured'] == "Yes")
                                    {
                                        echo '<div class="msg successmsg center">Featured</div>';
                                    }
                                    else
                                    {
                                        echo '<div class="msg errormsg center">Featured</div>';
                                    }

                                    ?>
                                    <?php

                                    if($row['active'] == "Yes")
                                    {
                                        echo '<div class="msg successmsg center">Active</div>';
                                    }
                                    else
                                    {
                                        echo '<div class="msg errormsg center">Active</div>';
                                    }

                                    ?>
                                </div>
                                <div class="content">
                                    <img src="images/star.png" alt="star">
                                    <h2><?php echo $row['title'] ?></h2>
                                </div>
                            </a>
                        <?php
                    }
                }
                else
                {
                    echo "<div class='msg warningmsg center m-auto'><i class='fas fa-exclamation-circle me-2'></i>Categories not found !!</div>";
                }
            }
        ?>
        </div>

</section>

<!-- Include Footer -->

<?php include 'footer.php' ?>