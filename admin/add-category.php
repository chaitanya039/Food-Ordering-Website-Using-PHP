<!-- Header goes here -->
<?php include 'partials/menu.php' ?>


<div class="add-category">
    
        <form action="" method="POST" enctype="multipart/form-data">
        <div class="image">
            <img src="../images/category.png" alt="category">
        </div>
            <h1><span><i class="fas fa-list-alt me-4"></i>Add Category</span></h1>

            <?php

                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];

                    // It should not display after reloading the page.

                    unset($_SESSION['add']);
                }

                if(isset($_SESSION['upload']))
                {
                    echo $_SESSION['upload'];

                    // It should not display after reloading the page.

                    unset($_SESSION['upload']);
                }

            ?>

                <div class="inputbox">
                    <span class="details">Title : </span>
                    <input type="text" name="title" placeholder="Enter Title">
                </div>
                <div class="inputbox">
                    <span class="details">Image : </span>
                    <input type="file" name="image">
                </div>
                <div class="inputbox">
                    <span class="details">Featured : </span>
                    <div class="radio">
                        <div>
                        <input type="radio" name="featured" value="Yes"> Yes
                        </div>
                        <div>
                        <input type="radio" name="featured" value="No"> No
                        </div>
                    </div>
                </div>
                <div class="inputbox">
                    <span class="details">Active : </span>
                    <div class="radio">
                        <div>
                        <input type="radio" name="active" value="Yes"> Yes
                        </div>
                        <div>
                        <input type="radio" name="active" value="No"> No
                        </div>
                    </div>
                </div>
                <div class="inputbox">
                    <input type="submit" name="submit" value="submit" class="btn btn3">
                </div>
            
        </form>
</div>


<!-- When form submitted then we are going to do this activity as follows -->

<?php

    if(isset($_POST['submit']))
    {
        // 1. Get the data from the form

        $title = $_POST['title'];
        $featured = isset($_POST['featured']) ? $_POST['featured'] : "No";
        $active = isset($_POST['active']) ? $_POST['active'] : "No";

        //  Check whether image is uploaded or not .

        if(isset($_FILES['image']['name']))
        {

            $image_name = $_FILES['image']['name'];
            
            if($image_name != "")
            {
                // Upload the image

                $source_path = $_FILES['image']['tmp_name'];

                // Auto rename for category images 

                $ext = end(explode('.', $image_name));

                $image_name = "Food_Category_". rand(000, 999) . "." . $ext;

                // now set destination path for it .

                $destination_path = "../images/category/" . $image_name;


                // finally upload it

                $upload = move_uploaded_file($source_path, $destination_path);

                // if upload is true,

                if($upload == false)
                {
                    $_SESSION['upload'] = "<div class='msg errormsg fw'><i class='fas fa-times-circle me-2'></i>Failed to upload image !!</div>";
                    header("location:" . SITEURL . "/admin/add-category.php");
                    die();
                }
            }
            else
            {
                // Do not upload the image
                $image_name = "";

            }
        }
        else
        {
            // Do not upload the image
            $image_name = "";

        }

        // 2. create a query to submit the form

        $query = "INSERT INTO category (title, image_name, featured, active) VALUES ('$title', '$image_name', '$featured', '$active')";

        // 3. Executing the query and get response from it

        $res = mysqli_query($con, $query);

        // 4. If res is true then,

        if($res == true)
        {
            $_SESSION['add'] = "<div class='msg successmsg'><i class='fas fa-check-circle me-2'></i>Category Added Successfully !!</div>";
            header("location:" . SITEURL . "/admin/manage-category.php");
        }
        else
        {
            $_SESSION['add'] = "<div class='msg errormsg fw'><i class='fas fa-times-circle me-2'></i>Failed to Add Category !!</div>";
            header("location:" . SITEURL . "/admin/add-category.php");
        }
    }

?>

<?php include "partials/footer.php" ?>