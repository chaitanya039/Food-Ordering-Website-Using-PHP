<!-- Include Header -->

<?php 
    
    include 'header.php';
?>

<section class="comman-hero contact">
    <div class="content">

    <h2>
        FILL BELOW <span>CON</span>TACT FORM TO COMMUNICATE US !
    </h2>

    <p>
        Give us chance to solve your problems...
    </p>
    </div>
</section>

    <!-- contact section starts here -->
    <section class="contact-alt">

    <?php
        if(isset($_SESSION['contact']))
        {
            echo $_SESSION['contact'];
            // It should not display after reloading the page.
            unset($_SESSION['contact']);
        }
    ?>

        <div class="icon-container">

            <div class="icons">
                <i class="fas fa-phone"></i>
                <h3>our number</h3>
                <p>+123-456-7890</p>
                <p>+111-222-3333</p>
            </div>

            <div class="icons">
                <i class="fas fa-envelope"></i>
                <h3>our email</h3>
                <p>chaitanyacp@gmail.com</p>
                <p>pansarechaitanya@gmail.com</p>
            </div>

            <div class="icons">
                <i class="fas fa-map-marker-alt"></i>
                <h3>our address</h3>
                <p>junnar, pune - 410502, maharastra</p>
            </div>

        </div>

        <div class="row">

            <form action="" method="POST">
                <h3><i class="fas fa-map-marker me-3"></i>get in touch</h3>
                <input type="text" name="name" id="" class="box" placeholder="Enter your name">
                <input type="number" name="phone" id="" class="box" placeholder="Enter your number">
                <input type="email" name="email" id="" class="box" placeholder="Enter your email">
                <textarea name="msg" id="msg" cols="30" rows="5" placeholder="Enter your message"></textarea>
                <input type="submit" name="submit" value = "Send Message" id="" class="btn">
            </form>

            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15071.138106319302!2d73.86646982784005!3d19.204611392226475!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bdd3fc48c5f335f%3A0x85ac387f9ae83c32!2sJunnar%2C%20Maharashtra%20410502!5e0!3m2!1sen!2sin!4v1645181124891!5m2!1sen!2sin"
             width="600" height="510" style="border:0;" allowfullscreen="" loading="lazy" class="map"></iframe>
        </div>

    </section>
    <!-- contact section ends here -->

    <!-- When form is submitted -->

    <?php

        if(isset($_POST['submit']))
        {
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $msg = $_POST['msg'];

            $query = "INSERT INTO contact (`name`, phone, email, msg) VALUES ('$name', '$phone', '$email', '$msg');";

            $res = mysqli_query($con, $query);

            if($res == true)
            {
                $_SESSION['contact'] = "<div class='msg successmsg fw'><i class='fas fa-check-circle me-2'></i>Message sent successfully !!</div>";
                $url = SITEURL . "/contact.php";
                echo "<script> window.location.href = '$url'; </script>";
            }
            else
            {
                $_SESSION['contact'] = "<div class='msg errormsg fw'><i class='fas fa-times-circle me-2'></i>Failed to send Message !!</div>";
                $url = SITEURL . "/contact.php";
                echo "<script> window.location.href = '$url'; </script>";
            }
        }
    ?>

<!-- Include Footer -->

<?php 
    
    include 'footer.php';
?>