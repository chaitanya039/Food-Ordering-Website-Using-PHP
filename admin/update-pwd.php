<!-- Header goes here -->
<?php include 'partials/menu.php' ?>

<?php

    // Get the id of record in which password will updated .

    $id = $_GET['id'];

?>

<div class="form-container">
    <form action="" method="POST">
        <h1><span><i class="fas fa-lock me-4"></i>Change Password</span></h1>
        <input type="text" name="current_password" placeholder="Current Password">
        <input type="password" name="new_password" placeholder="New Password">
        <input type="password" name="confirm_password" placeholder="Confirm Password">
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <input type="submit" class=" btn btn2 addAdminSubmit" name="submit" value="Submit">
    </form>
</div>

<!-- PHP Code goes here -->

<?php

    // 1. Get data using post

    if(isset($_POST['submit']))
    {
        $id = $_POST['id'];
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);

        // 2. Create a query to find out the record with current id and current password .

        $query = "SELECT * FROM admin WHERE id = $id AND password = '$current_password'";

        // 3. Execute the query .

        $res = mysqli_query($con, $query);

        // 4. If res is true then, record is found .

        if($res == true)
        {
            // Counting the number of rows.
            $count = mysqli_num_rows($res);

            if($count == 1)
            {
                // check whether new and confirm password is matched or not .
                if($new_password == $confirm_password)
                {
                    $query2 = "UPDATE admin SET password = '$new_password' WHERE id = $id";

                    $res2 = mysqli_query($con, $query2);

                    if($res2 == true)
                    {
                        $_SESSION['change-password'] = "<div class='msg successmsg'><i class='fas fa-check-circle me-2'></i>Password Changed Successfully !!</div>";

                        header("location:" . SITEURL . "/admin/manage-admin.php");
                    }
                    else
                    {
                        $_SESSION['change-password'] = "<div class='msg errormsg'><i class='fas fa-times-circle me-2'></i>Failed to change the Password !!</div>";

                        header("location:" . SITEURL . "/admin/manage-admin.php");
                    }
                }
                else
                {
                    $_SESSION['pwd-not-match'] = "<div class='msg errormsg'><i class='fas fa-times-circle me-2'></i>Password not match with each other !!</div>";
                    header("location:" . SITEURL . "/admin/manage-admin.php");
                }
            }
            else
            {
                // Add value to session variable for further purpose .
    
                $_SESSION['user-not-found'] = "<div class='msg errormsg'><i class='fas fa-times-circle me-2'></i>Existing password of user is wrong !!</div>";
    
                // Redirect to the manage admin page 
    
                header("location:" . SITEURL . "/admin/manage-admin.php");
            }
        }
    }

?>