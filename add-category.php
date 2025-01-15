<?php include('partials/menu.php'); ?>


<div class="main-content">
    <div class="wrapper">
       <h1>Add Category</h1>

       <br><br>

       <?php
           if(isset($_SESSION['add']))
           {
              echo $_SESSION['add'];
              unset($_SESSION['add']);
 
            }
           
            if(isset($_SESSION['upload']))
            {
               echo $_SESSION['upload'];
               unset($_SESSION['upload']);
  
             }

        ?>

       <br><br>

       <!-- Add category form starts -->
        <form action="" method="POST" enctype="multipart/form-data">  
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>

                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td> 
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>

                

            </table>
        </form>
       <!-- Add category form Ends -->

       <?php

            // check whether the submit button is clicked or not
            if(isset($_POST['submit']))
            {
               // echo "clicked";
               //2. get the values from category form
               $title = $_POST['title'];
               
               //3. for radio input ,we need to check whether the button
               if(isset($_POST['featured']))
               {
                // get the value from form
                $featured = $_POST['featured'];

               }
               else
               {
                   // set the default value
                   $featured = "No";
               }

               if(isset($_POST['active']))
               {
                    $active = $_POST['active'];
               }
               else
               {
                    $active = "No";
               }
                //check whether the image is seected or not and set the values for image name accordingly
                //print_r($_FILES['image']);

                //  die();//break the code here
                if(isset($_FILES['image']['name']))
                {
                    //upload the image
                    //to upload image we need img name source path and destination path
                    $image_name = $_FILES['image']['name'];

                    //upload the img only if img is selected
                    if($image_name != "")
                    {
                        
                       //auto rename our image
                       //get the extension of our image(jpg,png,gif)e.g. " Specialfood1.jpg"
                       $ext = end(explode('.',$image_name));

                       //rename the image
                       $image_name = "Food_Category_".rand(000, 999).'.'.$ext;//eg food_category_834.jpg

                       $source_path = $_FILES['image']['tmp_name'];

                       $destination_path = "../images/category/".$image_name;

                       //finally upload the image
                       $upload = move_uploaded_file($source_path, $destination_path);

                       //check whether the image is uploaded or not 
                       //and if the image is not uploaded then we will stop and redirect with error message
                       if($upload==false)
                       {
                          //set message
                          $_SESSION['upload'] ="<div class='error'>Failed to Upload Image.</div>";
                          //redirect to Add Category page
                          header('location:'.SITEURL.'admin/add-category.php');
                          //stop the process
                          die();

                        }

                    }

                }
                else
                {
                    //dont upload image set img name value is blank
                    $image_name="";
                }


                  //2.create sql query to insert category into databse
                  $sql = "INSERT INTO tbl_category SET
                  title = '$title',
                  image_name = '$image_name',
                  featured ='$featured',
                  active = '$active'
                  ";


                //3.execute the query and save in database
                $res = mysqli_query($conn, $sql);

                //4. check whether the query executed or not and data added or not
                if($res==true)
                {
                    //Query executed and Category Added
                    $_SESSION['add'] = "<div class='success'>Category Added Sucessfully.</div>";
                    //Redirect to manage category page
                    header('location:'.SITEURL.'admin/add-category.php');
                }
                else
                {
                    //failed to Add Category Added
                    $_SESSION['add'] = "<div class='error'>Failed to  Added Category.</div>";
                    //Redirect to manage category page
                    header('location:'.SITEURL.'admin/add-category.php');

                }

            }


        ?>


    </div>
</div>

 <?php include('partials/footer.php'); ?>


