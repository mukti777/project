<?php
    //Include Constants page
    include('../config/constants.php');

    // echo "delete food page ";

    if(isset($_GET['id']) && isset($_GET['image_name']))  //either use '&&' or 'AND'
    {
        //process to delete
        //echo "Process to Delete";

        // 1. Get id and image name
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //2. Remove the image if available 
        // Check whether the image is available or not and delete only if available
        if($image_name !="")
        {
            // if image has and need to remove from folder
            // Get the image Path
            $path = "../images/food/".$image_name;

            // Remove image file from folder
            $remove = unlink($path);

            // check whether the image is remove or not
            if($remove==false)
            {
                // failed to remove           
                $_SESSION['upload'] = "<div class='error'>Failed to Remove Image File.</div>";
                // redirect to manage food
                header('location:'.SITEURL.'admin/manage-food.php');

                die();
            }
        }

        //3. Delete food from database
        $sql = "DELETE FROM tbl_food WHERE id=$id";
        // Execute the query
        $res = mysqli_query($conn, $sql);


        // check whether the qurey executed or not and set the session message respectively
        //4. Redirect to manage foood with session message
        if($res==true)
        {
            // food deleted
            $_SESSION['delete'] = "<div class='success'>Food Deleted successfully</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else
        {
            // failed to Delete food
            $_SESSION['delete'] = "<div class='error'>Failed to Deleted food</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        } 



    }
    else
    {
        //Redirect to Manage food page
        // echo "Redirect";
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }
    

?>