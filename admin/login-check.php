<?php

    // include connection mysqli database
    include "../config/connection.php";

    // Authorization - for access control

    if(!isset($_SESSION['user']))
    {
        // Redirect to the login page

        $_SESSION['no-login-msg'] = "<div class='msg warningmsg fw' style='text-align : center;'><i class='fas fa-exclamation-circle me-3'></i>Please Login to access Admin Panel !!</div>";
        header('location:' . SITEURL . "/admin/login.php");
    }


?>