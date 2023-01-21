<!-- Menu goes here -->
<?php include 'partials/menu.php' ?>

    <div class="food container">
        <div class="wrapper">

            <h1 class="heading"><i class="fas fa-hamburger me-3"></i>Manage Foods</h1>

            <?php
                // Session variables goes here...
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];

                    // It should not display after reloading the page.

                    unset($_SESSION['add']);
                }

                if(isset($_SESSION['remove']))
                {
                    echo $_SESSION['remove'];

                    // It should not display after reloading the page.

                    unset($_SESSION['remove']);
                }

                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];

                    // It should not display after reloading the page.

                    unset($_SESSION['delete']);
                }

                if(isset($_SESSION['food-not-found']))
                {
                    echo $_SESSION['food-not-found'];

                    // It should not display after reloading the page.

                    unset($_SESSION['food-not-found']);
                }

                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];

                    // It should not display after reloading the page.

                    unset($_SESSION['update']);
                }
            ?>

            <a href="add-food.php" class="primary-btn"><i class="fas fa-plus-square me-3"></i>Add Food</a>

            <table class="admin-table food">

    <thead>
        <tr>
            <th>S.N</th>
            <th>Title</th>
            <th>Category</th>
            <th style="text-align: center !important;">Price</th>
            <th style="text-align: center !important;">Image</th>
            <th>Featured</th>
            <th>Active</th>
            <th>Description</th>
            <th style="text-align: center !important;">Actions</th>
        </tr>
    </thead>

    <tbody>
    <?php

        $query = "select * from food";

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
                            <td data-label="Title" class="fname"><?php echo $row['title'] ?></td>
                            <td data-label="Category"><?php

                                $id = $row['category_id'];
                                $query2 = "SELECT * FROM category WHERE id = $id";
                                $res2 = mysqli_query($con, $query2);

                                if($res2 == true)
                                {
                                    $count2 = mysqli_num_rows($res2);

                                    if($count2 == 1)
                                    {
                                        $row2 = mysqli_fetch_assoc($res2);

                                        echo $row2['title'];
                                    }
                                    else
                                    {
                                        ?>
                                            <div class='msg errormsg fw'><i class='fas fa-times-circle me-2'></i>Category not Found !!</div>
                                        <?php
                                    }
                                }

                             ?></td>
                             <td data-label="Price" style="text-align: center;"><i class="fas fa-inr me-2"></i><?php echo $row['price'] ?></td>
                            <td data-label="Image" style="text-align: center;">

                                <?php
                                    if($row['image_name'] != "")
                                    {
                                        ?>
                                        <img style="width: 15rem; object-fit:contain;" src="<?php echo SITEURL . "/images/Foods/" . $row['image_name'] ?>" alt="<?php $row['image_name'] ?>">
                                        <?php
                                    }
                                    else
                                    {
                                        echo "<div class='msg errormsg fw'><i class='fas fa-times-circle me-2'></i>Image is not Added by Admin !!</div>";
                                    }
                                ?>
                                
                            </td>
                            <td data-label="Featured"><?php echo $row['featured'] ?></td>
                            <td data-label="Active"><?php echo $row['active'] ?></td>
                            <td data-label="Description"><?php echo $row['description'] ?></td>
                            <td data-label="Actions">
                                <div class="op">
                                    <a class="icon" href=<?php echo SITEURL . "/admin/update-food.php?id=". $row['id']; ?> >
                                        <i class="fas fa-pencil"></i>
                                    </a>
                                    <a class="icon" href=<?php echo SITEURL . "/admin/delete-food.php?id=". $row['id'] . "&image=" . $row['image_name']; ?> >
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php
                    $row = mysqli_fetch_assoc($res); 
                }
            }
            else
            {
                ?>
                        
                <tr>
                    <td colspan="9" style="text-align: center;"> No Data Found !!</td>
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