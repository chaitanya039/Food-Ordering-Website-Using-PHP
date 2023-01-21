<!-- Header goes here -->
<?php include 'partials/menu.php' ?>


<div class="add-category food">
    
        <form action="" method="POST" enctype="multipart/form-data">
        <div class="image">
            <img src="../images/food.png" alt="category">
        </div>
            <h1><span>Add Food</span></h1>

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
                    <span class="details">Price : </span>
                    <input type="number" name="price" placeholder="Enter Price">
                </div>
                <div class="inputbox">
                    <span class="details">Category :</span>
                    <select name="category" id="cat">
                        <?php
                            // 1. select data from category table
                            $query = "SELECT * FROM category WHERE active = 'Yes'";

                            // 2. Execute the query
                            $res = mysqli_query($con, $query);

                            // res is true

                            if($res == true)
                            {
                                // 3. count the rows
                                $count = mysqli_num_rows($res);

                                // if count > 0
                                if($count > 0)
                                {
                                    while($row = mysqli_fetch_assoc($res))
                                    {
                                        ?>
                                            <option value="<?php echo $row['id'] ?>"><?php echo $row['title'] ?></option>
                                        <?php
                                    }
                                }
                                else
                                {
                                    ?>
                                        <option value="0">No Category Found.</option>
                                    <?php
                                }
                            }
                        ?>
                    </select>
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
                    <textarea style="padding: 1rem;" name="description" id="desc" cols="60" rows="5" placeholder="Enter Description of Food"></textarea>
                </div>
                <div class="inputbox">
                    <input type="submit" name="submit" value="submit" class="btn btn4">
                </div>
            
        </form>
</div>


<!-- When form submitted then we are going to do this activity as follows -->

<?php

    if(isset($_POST['submit']))
    {
        // 1. Get the data from the form

        $title = $_POST['title'];
        $category_id = $_POST['category'];
        $price = $_POST['price'];
        $description = addslashes($_POST['description']);
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

                $exts = end(explode('.', $image_name));

                $image_name = "Food_Item_". rand(0000, 9999) . "." . $exts;

                // now set destination path for it .

                $destination_path = "../images/Foods/" . $image_name;


                // finally upload it

                $upload = move_uploaded_file($source_path, $destination_path);

                // if upload is true,

                if($upload == false)
                {
                    $_SESSION['upload'] = "<div class='msg errormsg fw'><i class='fas fa-times-circle me-2'></i>Failed to upload image !!</div>";
                    $url = SITEURL . "/admin/add-food.php";
                    echo "<script> window.location.href = '$url'; </script>";
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

        $query2 = "INSERT INTO food (title, description, price, image_name, category_id, featured, active) VALUES ('$title', '$description', '$price', '$image_name', '$category_id' ,'$featured', '$active')";

        // 3. Executing the query and get response from it

        $res2 = mysqli_query($con, $query2);

        // 4. If res is true then,

        if($res2 == true)
        {
            $_SESSION['add'] = "<div class='msg successmsg'><i class='fas fa-check-circle me-2'></i>Food Added Successfully !!</div>";
            $url = SITEURL . "/admin/manage-food.php";
            echo "<script> window.location.href = '$url'; </script>";
        }
        else
        {
            $_SESSION['add'] = "<div class='msg errormsg fw'><i class='fas fa-times-circle me-2'></i>Failed to Add Food !!</div>";
            $url = SITEURL . "/admin/add-food.php";
            echo "<script> window.location.href = '$url'; </script>";
        }
    }   

?>

<?php include "partials/footer.php" ?>