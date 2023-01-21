<?php

    // Getting connection to mysql database .
    include "../config/connection.php";

    if(isset($_GET['id']))
    {
            // Deleting the admin from manage admin page .

        // 1. Getting id using $_GET super global variable that we passed in the manage admin page using anchor tag .

        $id = $_GET['id'];

        // 2. Creating the sql query to delete the record .

        $query = "DELETE FROM admin WHERE id = $id";

        // 3. Executing the Sql Query.

        $res = mysqli_query($con, $query);

        // 4. If res is true then fill SESSION Variable that accessible across the multiple pages .

        if($res == true)
        {
            $_SESSION['delete'] = "<div class='msg successmsg'><i class='fas fa-check-circle me-2'></i>Admin Deleted Successfully !!</div>";

            // Redirect to manage admin page only.

            header("location:".SITEURL."/admin/manage-admin.php");
        }

        // 5. If res is false then,

        else
        {
            $_SESSION['delete'] = "<div class='msg errormsg'><i class='fas fa-times-circle me-2'></i>Failed to delete Admin !!</div>";

            // Redirect to manage admin page only.

            header("location:".SITEURL."/admin/manage-admin.php");
        }
    }
    else
    {
        header("location:".SITEURL."/admin/manage-admin.php");
    }
    
?>