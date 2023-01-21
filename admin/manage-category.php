<!-- Menu goes here -->
<?php include 'partials/menu.php' ?>


    <div class="category container">
        <div class="wrapper">

            <h1 class="heading"><i class="fas fa-list-alt me-3"></i>Manage Category</h1>

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

                if(isset($_SESSION['category-not-found']))
                {
                    echo $_SESSION['category-not-found'];

                    // It should not display after reloading the page.

                    unset($_SESSION['category-not-found']);
                }

                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];

                    // It should not display after reloading the page.

                    unset($_SESSION['update']);
                }
            ?>

            <a href="add-category.php" class="primary-btn"><i class="fas fa-plus-square me-3"></i>Add Category</a>

            <table class="admin-table">

                <thead>
                    <tr>
                        <th>S.N</th>
                        <th>Title</th>
                        <th style="text-align: center !important;">Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <?php

                        $query = "select * from category";

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
                                            <td data-label="Image" style="text-align: center;">

                                                <?php
                                                    if($row['image_name'] != "")
                                                    {
                                                        ?>
                                                        <img style="width: 15rem; object-fit:contain;" src="<?php echo SITEURL . "/images/category/" . $row['image_name'] ?>" alt="<?php $row['image_name'] ?>">
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
                                            <td data-label="Actions">
                                                <div class="op">
                                                    <a class="icon" href=<?php echo SITEURL . "/admin/update-category.php?id=". $row['id']; ?>>
                                                        <i class="fas fa-pencil"></i>
                                                    </a>
                                                    <a class="icon" href=<?php echo SITEURL . "/admin/delete-category.php?id=". $row['id'] . "&image=" . $row['image_name']; ?> >
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
                                    <td colspan="6" style="text-align: center;"> No Data Found !!</td>
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
