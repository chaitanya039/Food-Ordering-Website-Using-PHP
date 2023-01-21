<!-- Include the menu.php -->
<?php  include "partials/menu.php"  ?>

<div class="add-category update food">
    
    <form action="" method="POST" enctype="multipart/form-data">
            <div class="image">
                <img src="../images/food.png" alt="food">
            </div>
            <h1><span>Update Food</span></h1>

            <?php
                    // 1. Getting the value of id from query string passed through manage admin page .

                    $id = $_GET['id'];

                    // 2. Getting data of that particular record .

                    $query = "SELECT * FROM food WHERE id = $id";

                    // 3. Executing the query .

                    $res = mysqli_query($con, $query);

                    
                    // 4. if res is true
                    
                    if($res == true)
                    {
                        // 5. Counting number of rows .
                        $count = mysqli_num_rows($res);

                        if($count == 1)
                        {
                            $row = mysqli_fetch_assoc($res);

                            ?>
                                
                            <div class="inputbox">
                                <span class="details">Title : </span>
                                <input type="text" name="title" value="<?php echo $row['title'] ?>">
                            </div>
                            <div class="inputbox">
                                <span class="details">Current Image : </span>
                                <?php
                                    if($row['image_name'] != "")
                                    {
                                        ?>
                                            <img style="width: 15rem; object-fit:contain;" src="<?php echo SITEURL . "/images/Foods/" . $row['image_name'] ?>" alt="">
                                        <?php
                                    }
                                    else
                                    {
                                        echo "<div class='msg errormsg fw'><i class='fas fa-times-circle me-2'></i>Image is not Added by Admin !!</div>";
                                    }
                                ?>
                            </div>
                            <div class="inputbox">
                                <span class="details">New Image : </span>
                                <input type="file" class="new" name="image">
                            </div>
                            <div class="inputbox">
                                <span class="details">Price : </span>
                                <input type="number" name="price" value="<?php echo $row['price'] ?>">
                            </div>
                            <div class="inputbox">
                                <span class="details">Category :</span>
                                <select name="category" id="cat">
                                    <?php
                                        $query3 = "SELECT * FROM category WHERE active = 'Yes'";
                                        $res3 = mysqli_query($con, $query3);
                                        if($res3 == true)
                                        {
                                            $count3 = mysqli_num_rows($res3);

                                            if($count3 > 0)
                                            {
                                                while($row3 = mysqli_fetch_assoc($res3))
                                                {

                                                    ?>
                                                        <option value ="<?php 
                                                            echo $row3['id'];?>"
                                                            <?php

                                                            // selecting the default as previous value
                                                            if($row3['id'] == $row['category_id'])
                                                            {
                                                                echo " selected";
                                                            }
                                                            ?>
                                                        >
                                                            <?php echo $row3['title'] ?>
                                                        </option>
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
                                        <input type="radio" name="featured" value="Yes" <?php if($row['featured'] == "Yes") { echo "checked"; } ?>> Yes
                                    </div>
                                    <div>
                                        <input type="radio" name="featured" value="No" <?php if($row['featured'] == "No") { echo "checked"; } ?>> No
                                    </div>
                                </div>
                            </div>
                            <div class="inputbox">
                                <span class="details">Active : </span>
                                <div class="radio">
                                    <div>
                                        <input type="radio" name="active" value="Yes" <?php if($row['active'] == "Yes") { echo "checked"; } ?>> Yes
                                    </div>
                                    <div>
                                        <input type="radio" name="active" value="No" <?php if($row['active'] == "No") { echo "checked"; } ?>> No
                                    </div>
                                </div>
                            </div>
                            <div class="inputbox">
                                <textarea style="padding: 1rem;" name="description" id="desc" cols="60" rows="5"><?php echo $row['description'] ?></textarea>
                            </div>
                            <div class="inputbox">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <input type="hidden" name="current_image" value="<?php echo $row['image_name']; ?>">
                                <input type="submit" name="submit" value="submit" class="btn btn4">
                            </div>
                            <?php
                        }
                        else
                        {
                            $_SESSION['food-not-found'] = '<div class="msg errormsg"><i class="fas fa-times-circle me-3"></i>No Food found !!</div>';
                            $url = SITEURL . "/admin/manage-food.php";
                            echo "<script> window.location.href = '$url'; </script>";
                        }
                    }
                
            ?>
    </form>
</div>

<?php
    if(isset($_POST['submit']))
    {
        // 1. Get the data from the form.
        $id = $_POST['id'];
        $price = $_POST['price'];
        $category_id = $_POST['category'];
        $description = addslashes($_POST['description']);
        $current_image = $_POST['current_image'];
        $title = $_POST['title'];
        $featured = $_POST['featured'];
        $active = $_POST['active'];

        // 2. Updating the image if selected

        if(isset($_FILES['image']['name']))
        {
            $image_name = $_FILES['image']['name'];

            if($image_name != "")
            {
                $source_path = $_FILES['image']['tmp_name'];

                // extension
                $ext = end(explode('.', $image_name));

                // Auto name for image

                $image_name = "Food_Item_" . rand(0000, 9999) . '.' . $ext;

                // Destination path

                $destination_path = "../images/Foods/" . $image_name;

                // upload the image

                $upload = move_uploaded_file($source_path, $destination_path);

                // if upload is true,

                if($upload == false)
                {
                    $_SESSION['upload'] = "<div class='msg errormsg fw'><i class='fas fa-times-circle me-2'></i>Failed to upload image !!</div>";
                    $url = SITEURL . "/admin/add-food.php";
                    echo "<script> window.location.href = '$url'; </script>";
                    die();
                }

                if($current_image != "")
                {
                    $path = "../images/Foods/" . $current_image;
                    $remove = unlink($path);

                      if($remove == false)
                      {
                          $_SESSION['remove'] = "<div class='msg errormsg fw'><i class='fas fa-times-circle me-2'></i>Failed to upload image !!</div>";
                          $url = SITEURL . "/admin/update-food.php";
                          echo "<script> window.location.href = '$url'; </script>";
                          die();
                      }
                }
            }
            else
            {
                $image_name = isset($current_image) ? $current_image : "";
            }
        }
        else
        {
            $image_name = isset($current_image) ? $current_image : "";
        }

        // 3. Update the database 

        $query2 = "UPDATE food SET title = '$title', description = '$description', price = '$price', image_name = '$image_name', category_id = '$category_id', featured = '$featured', active = '$active' WHERE id = $id";

        // 4. Executing the query

        $res2 = mysqli_query($con, $query2);

        // 5. if res is true then,

        if($res2 == true)
        {
            $_SESSION['update'] = "<div class='msg successmsg'><i class='fas fa-check-circle me-2'></i>Food Updated Successfully !!</div>";
            $url = SITEURL . "/admin/manage-food.php";
            echo "<script> window.location.href = '$url'; </script>";
        }
        else
        {
            $_SESSION['update'] = "<div class='msg errormsg'><i class='fas fa-times-circle me-2'></i>Failed to Update Food !!</div>";
            $url = SITEURL . "/admin/manage-food.php";
            echo "<script> window.location.href = '$url'; </script>";
        }
    }
?>

<?php include "partials/footer.php" ?>