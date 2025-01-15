<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>

        
        <br><br>

        <?php
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the Food">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of the Food."></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                
                <tr>
                    <td> Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">

                            <?php
                                //create PHP code to display categories from database
                                //1. create sql to get all active categories from database 
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                                $res = mysqli_query($conn, $sql);

                                //Count rows to check whether we have categories or not
                                $count  = mysqli_num_rows($res);

                                //if count is greater than zero we have categories else we dont have categories
                                if($count>0)
                                {
                                    //we have categories
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        //get the details of categories
                                        $id = $row['id'];
                                        $title = $row['title'];
                                        ?>
                                          <option value="<?php echo $id; ?>"><?php echo $title; ?></option>


                                        <?php

                                    }
                                } 
                                else
                                {
                                    //we dont have categories 
                                    ?>
                                    <option value="0">No Category Found</opton>
                                    <?php
                                }


                                //2. Display or dropdown 


                            ?>

                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No">No                                           
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No">No                                           
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                     </td>
                </tr>


            </table>

        </form>

        <?php
           
           //check whether the button is clicked or not 
           if(isset($_POST['submit']))
           {
                //Add the food in database
                //  echo "Clicked";

                //1. Get the data from form
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];

                //Check whether radio btn for featured and active are checked or not
                if(isset($POST['featured']))
                {
                    $featured = $_POST['featured'];
                }
                else
                {
                    $featured = "No"; //setting the default value
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No";  //Setting  default value
                }

                //2. Upload the image if selected

                //Check whether the select image is clicked or not and upload the image if the img is selected
                if(isset($_FILES['image']['name']))
                {
                    //Get the details of the selected image
                    $image_name = $_FILES['image']['name'];

                    //Check whether  the image is selected or not and upload image only if selected
                    if($image_name != "")
                    {
                        //Image is selected
                        //A. Rname the image
                        //Get the extension of selected image(jpg, png, gif, etc.)   "mukti.stha.jpg"  mukti-stha jpg              
                        $ext = end(explode('.', $image_name));

                        //Create New Name for Image
                        $image_name = "Food-Name-".rand(0000,9999).".".$ext;  //New Image MAy be "Food-Name-657.jpg"

                        //B. Upload the image
                        //Get the src path and destination path

                        //Source path is the current location of the image
                        $src = $_FILES['image']['tmp_name'];
                        
                        //Destination Path for the image to be uploaded
                        $dst = "../images/food/".$image_name;
                       
                        //Finally upload the food image
                        $upload = move_uploaded_file($src, $dst);

                        //Check whether image uploaded of not
                        if($upload==false)
                        {
                            //Failed to upload the image 
                            //redirect to Add Food Page
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                            header('location:'.SITEURL.'admin/add-food.php');
                            //stop the process
                            die();
                        }

                    }

                }
                else
                {
                    $image_name = ""; //setting default value as blank
                }
                //3. Insert into Database

                //Create a SQL query to save or Add Food
                // for numerical we do not need to pass value inside quotes '' but for string value it is compulsary to add quotes ''
                $sql2 = "INSERT INTO tbl_food SET
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = $category,
                    featured = '$featured',
                    active = '$active'

                ";

                //execute the query
                $res2 = mysqli_query($conn, $sql2);

                //check whether data inserted or not

                if($res2 == true)
                {
                    //data inserted sucessfully
                    $_SESSION['add'] = "<div class='success'>Food Added Sucessfully.</div>";
                    //4. Redirect with message to manage food page
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                else
                {
                    //failed to insert data
                    $_SESSION['add'] = "<div class='error'>Failed  to Add Food.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }


                
            }


        ?>
    </div>
</div>


<?php include('partials/footer.php');?>

