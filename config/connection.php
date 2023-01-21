<?php
    // Starts your php session...

    session_start();

    // Define your constants...

      define('LOCALHOST', 'localhost');
      define('USERNAME', 'root');
      define('PASSWORD', '');
      define('DB', 'food-order');
      define('SITEURL', 'http://localhost/food-order');

    //  define('LOCALHOST', 'sql212.epizy.com');
    //  define('USERNAME', 'epiz_32864407');
    //  define('PASSWORD', 'FLQXZzF9HHK8');
    //  define('DB', 'epiz_32864407_foodorder');
    //  define('SITEURL', 'http://yummy.great-site.net');

    // Let's connect php code to your mySql database...
    $con = mysqli_connect(LOCALHOST, USERNAME, PASSWORD); // connect to db
    $db_select = mysqli_select_db($con, DB);

    if($con)
    {
        return;
    }
    else
    {
    ?>
        <script>
            alert("Database server connection failed...");
        </script>
    <?php
    }

?>