<?php

   //Include constants.php file here
   include('../config/constants.php');


   // 1. Get the id of admin to be deleted
   $id = $_GET['id'];

   // 2. create SQL Query to Delete Admin
   $sql = "DELETE FROM tbl_admin WHERE id=$id";

   //Excute the query
   $res = mysqli_query($conn, $sql);

   //Check whether the query excuted sucessfully or not 
   if($res==true)
   {
      //query excuted sucessfully and admin deleted 
      // echo "Admin Deleted";
      //Create a session variable to display message
      $_SESSION['delete'] = "<div class='success'>Admin Deleted sucessfully.</div>";
      //Redirect to Manage Admin Page
      header('location:'.SITEURL.'admin/manage-admin.php');

   }
   else
   {
      //Failed to Delete admin
      // echo "Failed to Deleted Admin";
      $_SESSION['delete'] = "<div class='error'>Failed to Delete Admin.try again later.</div>";
      header('location:'.SITEURL.'admin/manage-admin.php');

   }


   // 3. redirect to Manage Admin page with message (sucesss/error)
   
?>