<?php

    // include connection mysqli database
    include "../config/connection.php";

    // destroy the session varaibles 

    session_destroy();

    // Redirect to the login page

    $_SESSION['logout-admin'] = "<div class='msg successmsg fw'><i class='fas fa-check-circle me-2'></i>Admin logged out Successfully !!</div>";
    header('location:' . SITEURL . "/admin/login.php");


?>