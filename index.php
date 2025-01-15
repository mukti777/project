    <?php include('partials-front/menu.php'); ?>

     
    <!-- food search section starts here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">

            </form>
        </div>

    </section>
     <!-- food search section Ends here -->

    <?php
        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
    ?>

    
    <!-- Categories section starts here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
                //Create SQL Query to display categories from database
                $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
                //Execute the query
                $res = mysqli_query($conn, $sql);
                //Count rows to check whether the category is available
                $count = mysqli_num_rows($res);

                if($count>0)
                {
                    //categories available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Get the values like id, title, image_name
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>

                        <a href="<?php echo SITEURL;?>category-foods.php?category_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">
                                <?php
                                    // check whether image is available or not
                                    if($image_name=="")
                                    {
                                        //display msg
                                        echo "<div class='error'>Image not available.</div>";
                                    }
                                    else
                                    {
                                        //image available
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="pizza" class="img-responsive img-curve">
                                        <?php

                                    }

                                    
                                ?>
                              
                               <h3 class="float-text text-white">Pizza</h3>
                            </div>
                        </a>

                        <?php
                    }
                }
                else
                {
                    //categories not avaailable
                    echo "<div class='error'>Category not Added.</div>";
                }


            ?>
                                                     

            <div class="clearfix"></div>

        </div>


    </section>
    <!-- Categories section ends here -->
     
     
    <!-- Food Menu starts here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                //Getting foods from database that are active and featured
                //SQL query
                $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";

                //execute the query 
                $res2 = mysqli_query($conn, $sql2);

                //count rows
                $count2 = mysqli_num_rows($res2);

                //check whether food available or not
                if($count2>0)
                {
                    //food available
                    while($row = mysqli_fetch_assoc($res2))
                    {
                        //get all the value
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
                        ?>
                        <div class="food-menu-box">
                            <div class="food-menu-img">

                                <?php
                                    //Check whether image available or not
                                    if($image_name=="")
                                    {
                                        //image not available
                                        echo "<div class='error'>Image not available.</div>";
                                    }
                                    else
                                    {
                                        //image available
                                        ?>
                                        <img src="<?php echo SITEURL ;?>images/food/<?php echo $image_name; ?>" alt="chicke  Pizza" class="img-responsive img-curve">                        
                                        <?php

                                    }
                                
                                ?>
                                
                            </div>

                            <div class="food-menu-desc">
                               <h4><?php echo $title;?>Pizza</h4>
                               <p class="food-price">Rs<?php echo $price; ?></p>
                               <p class="food-detail">
                                  <?php echo $description;?>
                               </p>
                               <br>

                                <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>

                        <?php
                    }
                    
                }
                else
                {
                    //food not available
                    echo "<div class='error'>Food not available.</div>";
                }


            
            ?>
           
                                                            
            <div class="clearfix"></div>
        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>

        
    </section>
    <!-- Food Menu Ends here -->
        
    
   <?php include('partials-front/footer.php'); ?>