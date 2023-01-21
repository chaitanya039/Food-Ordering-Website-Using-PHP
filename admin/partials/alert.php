<!-- Custom Alert !! -->

<?php 
        if(isset($_SESSION['alert']))
        {
            if($_SESSION['alert'] == "success")
            {
                ?>
                    <div class="alert hide success">
                        <span class="icon fas fa-check-circle me-2"></span>
                        <span class="msg">Admin Added Successfully !!</span>
                        <div class="close-btn">
                            <span class="fas fa-times"></span>
                        </div>
                    </div>
                <?php
                $_SESSION['alert'] = "";
            }
            else if($_SESSION['alert'] == "danger")
            {
                ?>
                    <div class="alert hide danger">
                        <span class="icon fas fa-times-circle me-2"></span>
                        <span class="msg">Please Fill all fields correctly !!</span>
                        <div class="close-btn">
                            <span class="fas fa-times"></span>
                        </div>
                    </div>
                <?php
                $_SESSION['alert'] = "";
            }
            else if($_SESSION['alert'] == "warning")
            {
                ?>
                    <div class="alert hide">
                        <span class="icon fas fa-exclamation-circle me-2"></span>
                        <span class="msg">Something went wrong !!</span>
                        <div class="close-btn">
                            <span class="fas fa-times"></span>
                        </div>
                    </div>
                <?php
                $_SESSION['alert'] = "";
            }
        }
?>