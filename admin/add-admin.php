<!-- Header goes here -->
<?php include 'partials/menu.php' ?>


<div class="form-container">
    <form action="" method="POST">
        <h1><span><i class="fas fa-user me-4"></i>Add Admin</span></h1>
        <input type="text" name="fullname" placeholder="Enter Your Full Name">
        <input type="text" name="username" placeholder="Enter Your Username">
        <input type="password" name="password" placeholder="Enter Your Password">
        <input type="submit" class=" btn btn2 addAdminSubmit" name="submit" value="Submit">
    </form>
</div>

<!-- PHP code starts here -->
<?php 


// In short, check whether submit button is clicked or not.

if(isset($_POST['submit']))
{

        // 1. Get data from the form using $_POST superglobals...
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); // Password encryption with md5 hashing algorithm...

        // 2. Sql query and save data into database...

        $sql = "INSERT INTO admin (full_name, username, password) values ('$fullname', '$username', '$password')";

        // 3. Executing the sql query and save data into database...

        $res = mysqli_query($con, $sql) or die(mysqli_error($con));

        // 4. Check whether the data (Query is executed or not) is inserted or not...
        if($res == true)    
        {
            // Add data to session variable.
            $_SESSION['add'] = "<div class='msg successmsg'><i class='fas fa-check-circle me-2'></i>Admin Added Successfully !!</div>";

            // Redirect to manage admin page.
            header('location:' . SITEURL . '/admin/manage-admin.php');
        }
        else
        {
            // Add Data to session variable.
            $_SESSION['add'] = "<div class='msg errormsg'><i class='fas fa-times-circle me-2'></i>Failed to Add Admin !!</div>";

            // Redirect to manage admin page.
            header('location:' . SITEURL . '/admin/manage-admin.php');
        }

    }

    ?>

<!-- Footer goes here -->
<?php include 'partials/footer.php' ?>