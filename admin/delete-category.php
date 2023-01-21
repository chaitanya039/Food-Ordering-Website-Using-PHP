<!-- include connection php -->

<?php 

include "../config/connection.php";

// if id and image passed from query string then,

if(isset($_GET['id']) AND isset($_GET['image']))
{
    // 1. get this value into variable first

    $id = $_GET['id'];
    $image = $_GET['image'];

    // 2. check image is added or not to delete it

    if($image != "")
    {
        // take a path pf image to delete it
        $path = "../images/category/" . $image;

        // Remove the image
        $remove = unlink($path);

        // unable to remove the file
        if($remove == false)
        {
            $_SESSION['remove'] = "<div class='msg errormsg'><i class='fas fa-times-circle me-2'></i>Unable to remove the image !!</div>";
            header("location:" . SITEURL . "/admin/manage-category.php");
            die();
        }
    }

        // Able to removing the file

        $query = "DELETE FROM category WHERE id = $id ";

        // executing the query

        $res = mysqli_query($con, $query);

        // res is true then,

        if($res == true)
        {
            $_SESSION['delete'] = "<div class='msg successmsg'><i class='fas fa-check-circle me-2'></i>Category Deleted Successfully !!</div>";
            header("location:" . SITEURL . "/admin/manage-category.php");
        }
        else
        {
            $_SESSION['delete'] = "<div class='msg errormsg'><i class='fas fa-times-circle me-2'></i>Failed to Delete Category !!</div>";
            header("location:" . SITEURL . "/admin/manage-category.php");
        }

}
else
{
    header("location:" . SITEURL . "/admin/manage-category.php");
}


?>

