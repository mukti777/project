<?php include('partials/menu.php'); ?>


  <div class="main-content">
    <div class="wrapper">
      <h1>Add Admin</h1>

      <br><br>

      <?php
          if(isset($_SESSION['add']))
          {
            echo $_SESSION['add'];  //Displaying session Message
            unset($_SESSION['add']);  // Removing session Message
          }
      ?>
      
      <form action="" method="POST">

        <table class="tbl-30">
            <tr>
                <td>Full Name:</td>
                <td><input type="text" name="full_name" placeholder="Enter your name"><td>

            </tr>

            <tr>
                <td>Username: </td>
                <td><input type="text" name="username" placeholder="Enter your username"><td>

            </tr>

            <tr>
                <td>Password: </td>
                <td><input type="password" name="password" placeholder="Your Password"><td>

            </tr>

            <tr>
                <td colspan="2">
                <input type="submit" name="submit" value="Add Admin" class="btn-secondary">


                </td>
                
            </tr>

        </table>

      </form>
    </div>

</div>

   
   
<?php include('partials/footer.php'); ?>

<?php
     // process the value form and save it on database


     //check whether the button is clicked or not

     if(isset($_POST['submit']))
     {
         // buttton clicked
        //  echo "button clicked";

        //1.get the data from form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); //password encryption with md5

        //2. SQL query to save the data into database
        $sql = "INSERT INTO tbl_admin SET
          full_name='$full_name',
          username='$username',
          password='$password'

        ";
       
      
       //3. excute query and saving data into database
        $res = mysqli_query($conn, $sql) or die (mysqli_error());


      //4. check whether the query is excutedly data is inserted or not and dispaly a message
        if($res==TRUE)
        {
          //Data Inserted
          //echo "Data Inserted";
          //create a session to display Message
          $_SESSION['add'] = "Admin Added sucessfully";
          //Redirect page to manage admin
          header("location:".SITEURL.'admin/manage-admin.php');

        }
        else
        {
          //Failed to Insert Data
          //echo "Failed to insert Data";
           //create a session to display Message
           $_SESSION['add'] = "Failed to Added Admin";
           //Redirect page to Add admin
           header("location:".SITEURL.'admin/add-admin.php');
         
        }

     } 

?>