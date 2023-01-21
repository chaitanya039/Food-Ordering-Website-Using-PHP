<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

        <!-- Stylesheet -->
        <link rel="stylesheet" href="../css/admin.css">

        <!-- Font awesome cdn -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Swiper cdn for css -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
</head>
<body>

    <!-- Get your connection to database -->
    <?php 
        include '../config/connection.php';
    ?>
    
    <div class="form-container login">
        <form action="" method="POST">
            <h1><span><i class="fas fa-user-circle me-3"></i>ADMIN LOGIN</span></h1>
            <div class="image-container">
                <img src="../images/admin.png" alt="admin">
            </div>

            <?php

                if(isset($_SESSION['login-admin']))
                {
                    echo $_SESSION['login-admin'];
                    // It should not display after reloading the page.
                    unset($_SESSION['login-admin']);
                }

                if(isset($_SESSION['logout-admin']))
                {
                    echo $_SESSION['logout-admin'];
                    // It should not display after reloading the page.
                    unset($_SESSION['logout-admin']);
                }

                if(isset($_SESSION['no-login-msg']))
                {
                    echo $_SESSION['no-login-msg'];
                }

            ?>

            <input type="text" name="username" placeholder="Username">
            <input type="password" name="password" placeholder="Password">
            <input type="submit" class=" btn btn2 addAdminSubmit" name="submit" value="Login">
            <div style="font-style:italic; letter-spacing : .7px;"><i class="fas fa-share me-2"></i>Created by Chaitanya Pansare...</div>
        </form>
    </div>

    <?php

    if(isset($_POST['submit']))
    {
        // 1. Get the data from the form.
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $password = mysqli_real_escape_string($con, md5($_POST['password']));

        // 2. Create a query to get data from the database.
        $query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";

        // 3. Execute the query .
        $res = mysqli_query($con, $query);

        // 4. Check res and count the return rows
        if($res == true)
        {
            $count = mysqli_num_rows($res);

            if($count == 1)
            {
                $_SESSION['login-admin'] = "<div class='msg successmsg fw'><i class='fas fa-check-circle me-2'></i>Admin logged in Successfully !!</div>";
                $_SESSION['user'] = $username; // for authorization purpose
                header("location:". SITEURL . "/admin/index.php");
            }
            else
            {
                $_SESSION['login-admin'] = "<div class='msg errormsg fw'><i class='fas fa-times-circle me-2'></i>Admin does not exists !!</div>";
                header("location:". SITEURL . "/admin/login.php");
            }
        }
    }

    ?>
</body>
</html>

