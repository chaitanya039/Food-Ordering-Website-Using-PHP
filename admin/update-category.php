<!-- Include the menu.php -->
<?php  include "partials/menu.php"  ?>

<div class="add-category update">
    
    <form action="" method="POST" enctype="multipart/form-data">
            <div class="image">
                <img src="../images/category.png" alt="category">
            </div>
            <h1><span><i class="fas fa-list-alt me-4"></i>Update Category</span></h1>

            <?php
                if(isset($_SESSION['remove']))
                {
                    echo $_SESSION['remove'];

                    unset($_SESSION['remove']);
                }
            ?>

            <?php

                if(isset($_GET['id']))
                {
                    // 1. Getting the value of id from query string passed through manage admin page .

                    $id = $_GET['id'];

                    // 2. Getting data of that particular record .

                    $query = "SELECT * FROM category WHERE id = $id";

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
                                            <img style="width: 15rem; object-fit:contain;" src="<?php echo SITEURL . "/images/category/" . $row['image_name'] ?>" alt="">
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
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <input type="hidden" name="current_image" value="<?php echo $row['image_name']; ?>">
                                <input type="submit" name="submit" value="submit" class="btn btn3">
                            </div>
                            <?php
                        }
                        else
                        {
                            $_SESSION['category-not-found'] = '<div class="msg errormsg"><i class="fas fa-times-circle me-3"></i>No Category found !!</div>';
                            header("location:".SITEURL."/admin/manage-category.php"); 
                        }
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

                $image_name = "Food_Category_" . rand(000, 999) . '.' . $ext;

                // Destination path

                $destination_path = "../images/category/" . $image_name;

                // upload the image

                $upload = move_uploaded_file($source_path, $destination_path);

                // if upload is true,

                if($upload == false)
                {
                    $_SESSION['upload'] = "<div class='msg errormsg fw'><i class='fas fa-times-circle me-2'></i>Failed to upload image !!</div>";
                    header("location:" . SITEURL . "/admin/add-category.php");
                    die();
                }

                if($current_image != "")
                {
                    $path = "../images/category/" . $current_image;
                    $remove = unlink($path);

                     if($remove == false)
                     {
                         $_SESSION['remove'] = "<div class='msg errormsg fw'><i class='fas fa-times-circle me-2'></i>Failed to remove image !!</div>";
                         $url = SITEURL . "/admin/update-category.php";
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

        $query2 = "UPDATE category SET title = '$title', image_name = '$image_name', featured = '$featured', active = '$active' WHERE id = $id";

        // 4. Executing the query

        $res2 = mysqli_query($con, $query2);

        // 5. if res is true then,

        if($res2 == true)
        {
            $_SESSION['update'] = "<div class='msg successmsg'><i class='fas fa-check-circle me-2'></i>Category Updated Successfully !!</div>";
            $url = SITEURL . "/admin/manage-category.php";
            echo "<script> window.location.href = '$url'; </script>";
        }
        else
        {
            $_SESSION['update'] = "<div class='msg errormsg'><i class='fas fa-times-circle me-2'></i>Failed to Update Category !!</div>";
            $url = SITEURL . "/admin/manage-category.php";
            echo "<script> window.location.href = '$url'; </script>";
        }
    }
?>

<?php include "partials/footer.php" ?>