<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yummy - The food ordering website...</title>

    <!-- Stylsheet -->
    <link rel="stylesheet" href="css/style.css">

    <!-- font awesome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Swiper cdn for css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />

</head>

    <?php include "config/connection.php" ?>

    <!-- Header section starts here -->

    <header class="header">
        <a href="#" class="logo">
            <img src="images/main-logo.png" alt="yummy food">
        </a>
        <nav class="navbar">
            <div id="close-btn" class="fas fa-times"></div>
            <a href="<?php echo SITEURL ?>" class="menu-item" id="home">Home</a>
            <a href="<?php echo SITEURL ?>/category.php" class="menu-item">Categories</a>
            <a href="<?php echo SITEURL ?>/food.php" class="menu-item">Foods</a>
            <a href="<?php echo SITEURL ?>/contact.php" class="menu-item">Contact</a>
            <a href="<?php echo SITEURL ?>/about.php" class="menu-item">About us</a>
        </nav>
        <div class="search-form">
          <div id="menu-btn" class="fas fa-bars"></div>
          <div id="search-btn" class="fas fa-search"></div>
          <form action="<?php echo SITEURL . "/food-search.php" ?>" method="POST" id="search-form">
          <input type="search" name="search" id="search" placeholder="Search foods..." required>
          <input type="submit" class="btn" value="Search">
          </form>
        </div>
    </header>

    <!-- Header section ends here -->

<body>
