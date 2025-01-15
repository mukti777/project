<?php
    // include constant file
    include('../config/constants.php');
    
    // check weather the id and image_name value is set or not
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        // Get the value and delete 
           // echo "Get value and Delete"
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        // remove the physical img file is available
        if($image_name != "")
        {
            // image is available. so remove it
            $path = "../images/category/".$image_name;
            // remove the image
            $remove = unlink($path);

            // if failed to remove image then add an error message and stop the process
            if($remove==false)
            {
                // set the Session Message
                $_SESSION['remove'] = "<div class='error'>Failed to Remove category Image.</div>";
                // Redirect to manage category page
                header('loaction:'.SITEURL.'admin/manage-category.php');
                // stop the process
                die();  
            }
        }

        // delete data from database
        // SQL Query to Delete data from database
        $sql = "DELETE FROM tbl_category WHERE id=$id";

        // Execute the Query 
        $res = mysqli_query($conn, $sql);

        // Check whether the data is delete from databse or not
        if($res==true)
        {
            // SEt Success message
            $_SESSION['delete'] = "<div class='success'>Category Deleted successfully</div>";
            // Redirect to manage category page
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            // Set fail message
            $_SESSION['delete'] = "<div class='error'>Failed to delete Category.</div>";
            // Redirect to manage category page
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        
        
    }
    else
    {
        // redirect to manage category page
        header('location:'.SITEURL.'admin/manage-category.php');
    }
?>
