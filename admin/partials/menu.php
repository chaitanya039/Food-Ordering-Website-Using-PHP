<!-- Get your connection to database -->
<?php 
    //include '../config/connection.php';
    include "login-check.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Yummy</title>

    <!-- Stylesheet -->
    <link rel="stylesheet" href="../css/admin.css">

    <!-- Font awesome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Swiper cdn for css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    
</head>
<body>


<div class="page-container">
    <div class="header">
        <div class="wrapper">
            <div class="image">
                <img src="../images/logo.png" alt="">
            </div>
            <div class="menu-items">
                <a href="index.php">Home</a>
                <a href="manage-admin.php">Admin</a>
                <a href="manage-category.php">Category</a>
                <a href="manage-food.php">Food</a>
                <a href="manage-order.php">Order</a>
                <a href="logout.php">Logout</a>
            </div>
            <div class="icons">
                <div href="#" class="btn btn2 set"><i class="fas fa-cogs me-2"></i>Settings</div>
            </div>
        </div>
    </div>