<!-- Menu goes here -->
<?php include 'partials/menu.php' ?>


    <div class="admin container">
        <div class="wrapper">

            <h1 class="heading"><i class="fas fa-user-circle me-3"></i>Manage Admin</h1>

            <?php

                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];

                    // It should not display after reloading the page.

                    unset($_SESSION['add']);
                }

                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];

                    // It should not display after reloading the page.

                    unset($_SESSION['delete']);
                }

                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];

                    // It should not display after reloading the page.

                    unset($_SESSION['update']);
                }

                if(isset($_SESSION['user-not-found']))
                {
                    echo $_SESSION['user-not-found'];

                    // It should not display after reloading the page.

                    unset($_SESSION['user-not-found']);
                }

                if(isset($_SESSION['pwd-not-match']))
                {
                    echo $_SESSION['pwd-not-match'];

                    // It should not display after reloading the page.

                    unset($_SESSION['pwd-not-match']);
                }

                if(isset($_SESSION['change-password']))
                {
                    echo $_SESSION['change-password'];

                    // It should not display after reloading the page.

                    unset($_SESSION['change-password']);
                }

                if(isset($_SESSION['admin-not-found']))
                {
                    echo $_SESSION['admin-not-found'];

                    // It should not display after reloading the page.

                    unset($_SESSION['admin-not-found']);
                }

            ?>

            <a href="add-admin.php" class="primary-btn"><i class="fas fa-plus-square me-3"></i>Add Admin</a>

            <table class="admin-table admin">

                <thead>
                    <tr>
                        <th>S.N</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <?php

                        $query = "select * from admin";

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
                                            <td data-label="Full Name" class="fname"><?php echo $row['full_name'] ?></td>
                                            <td data-label="Username"><?php echo $row['username'] ?></td>
                                            <td data-label="Actions" class="op">
                                                <a class="icon" href=<?php echo SITEURL . "/admin/update-admin.php?id=". $row['id']; ?> >
                                                    <i class="fas fa-pencil"></i>
                                                </a>
                                                <a class="icon" href=<?php echo SITEURL . "/admin/delete-admin.php?id=". $row['id']; ?> >
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                                <a class="icon" href=<?php echo SITEURL . "/admin/update-pwd.php?id=". $row['id']; ?> >
                                                    <i class="fas fa-key"></i>
                                                </a>
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
