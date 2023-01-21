<!-- Include Header -->

<?php include 'header.php' ?>

<section class="food-search">

    <?php
        $search = mysqli_real_escape_string($con, $_POST['search']);
    ?>

    <h2><i class="fas fa-cutlery me-4"></i>Foods on your search  <a href="#" class="ms-2"><?php echo '"' .$search . '..."'; ?></a> </h2>

</section>

<section class="food-search-alt food-alt">

        <div class="heading-container">
            <div class="sub-title">Get Your Delious</div>
            <div class="title">Foods</div>
            <div class="bottom-dots">
                <span class="dot line-dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
            </div>
        </div>

        <div class="card-container">

            <?php

                // 1. Create query

                $query = "SELECT * FROM food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

                // 2. Execute query

                $res = mysqli_query($con, $query);

                if($res == true)
                {
                    // 3. Count rows

                    $count = mysqli_num_rows($res);

                    if($count > 0)
                    {
                        while($row = mysqli_fetch_assoc($res))
                        {
                            ?>
                                <div class="card">
                                    <div class="image">
                                        <?php 

                                            if($row['image_name'] != "")
                                            {
                                                ?>
                                                    <img src="<?php echo SITEURL . "/images/Foods/" . $row['image_name'] ?>" alt="">
                                                <?php
                                            }
                                            else
                                            {
                                                echo "<div class='msg warningmsg fw'><i class='fas fa-exclamation-circle me-2'></i>Image is not Available !!</div>";
                                            }
                                        ?>
                                    </div>
                                    <div class="content">
                                        <div class="sub-title">
                                            <?php

                                                $category_id = $row['category_id'];
                                                $query2 = "SELECT title FROM category WHERE id = $category_id";
                                                $res2 = mysqli_query($con, $query2);
                                                $row2 = mysqli_fetch_assoc($res2);
                                                echo $row2['title'];
                                            ?>
                                        </div>
                                        <div class="title"><?php echo $row['title'] ?></div>
                                        <p class="desc"><?php echo $row['description'] ?></p>
                                        <div class="price"><i class="fas fa-inr me-3"></i><?php echo $row['price'] ?></div>
                                        <a href="<?php echo SITEURL . "/order.php?food_id=" . $row['id'] ?>" class="primary-btn"><i class="fas fa-play-circle me-3"></i>Order now</a>
                                    </div>
                                </div>
                            <?php
                        }
                    }
                    else
                    {
                        echo "<div class='msg warningmsg center m-auto'><i class='fas fa-exclamation-circle me-2'></i>Foods not found !!</div>";
                    }
                }
            ?>
        </div>
</section>


<!-- Include Footer -->

<?php include 'footer.php' ?>