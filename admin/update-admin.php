<!-- Header goes here -->
<?php include 'partials/menu.php' ?>

<!-- PHP code starts here -->

<?php

    // 1. Getting the value of id from query string passed through manage admin page .

    $id = $_GET['id'];

    // 2. Getting data of that particular record .

    $query = "SELECT * FROM admin WHERE id = $id";

    // 3. Executing the query .

    $res = mysqli_query($con, $query);

    // 4. Counting number of rows .

    $count = mysqli_num_rows($res);

    // 5. if res is true

    if($res == true)
    {
        if($count == 1)
        {
            $row = mysqli_fetch_assoc($res);

            ?>
                
            <div class="form-container">
                <form action="" method="POST">
                    <h1><span><i class="fas fa-user me-4"></i>Update Admin</span></h1>
                    <input type="text" name="fullname" value="<?php echo $row['full_name'] ?>" >
                    <input type="text" name="username" value="<?php echo $row['username'] ?>">
                    <input type="hidden" name="id" value="<?php echo $row['id'] ?>" >
                    <input type="submit" class=" btn btn2 addAdminSubmit" name="submit" value="Submit">
                </form>
            </div>
            <?php
        }
        else
        {
            $_SESSION['admin-not-found'] = '<div class="msg errormsg"><i class="fas fa-times-circle me-3"></i>No Admin found !!</div>';
            header("location:".SITEURL."/admin/manage-admin.php"); 
        }
    }

    // when we submit the form .

    if(isset($_POST['submit']))
    {
        // 1. Get the data from user using POST superglobal variable .

        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $id = $_POST['id'];

        // 2. Create query for updating the record .

        $query = "UPDATE admin SET full_name = '$fullname', username = '$username' WHERE id = $id";

        // 3. Executing the query .

        $res = mysqli_query($con, $query);

        // 4. If res is true then,

        if($res == true)
        {
            // Set value to SESSION variable .

            $_SESSION['update'] = "<div class='msg successmsg'><i class='fas fa-check-circle me-2'></i>Admin Updated Successfully !!</div>";

            // Redirect to manage admin page only.

            header("location:".SITEURL."/admin/manage-admin.php");
        }

        // 5. if res is false then,

        else
        {
            $_SESSION['update'] = "<div class='msg errormsg'><i class='fas fa-times-circle me-2'></i>Failed to update Admin !!</div>";

            // Redirect to manage admin page only.

            header("location:".SITEURL."/admin/manage-admin.php");
        }
    }


?>

<?php include "partials/footer.php" ?>
