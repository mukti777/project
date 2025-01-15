<?php include('../config/constants.php'); ?>
<html>
    <head>
        <title>login -food os</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>

        <div class="login">
            <h1 class="text-center">login</h1>
            <br><br>
            <?php
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
                
            ?>
            <br><br>
            <!-- login form starts here -->
            <form action="" method="POST"class="text-center">
            Username: <br>
            <input type="text" name="username" placeholder="Enter Username"><br><br>
            Password: <br>
            <input type="text" name="password" placeholder="Enter Password"><br><br>

            <input type="submit" name="submit" value="login" class="btn-primary"> 
            <br><br>           
            </form>


            <!-- login form ends here -->


            <p class="text-center">created by - <a href="www.google.com">google</a></p>

        </div>


    </body>

</html>
<?php
    
    //check whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        //process for login
        //1.Get the data from login form
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        //2. SQL to check whether the user with username and password exist or not
        $sql = "SELECT * FROM tbl_admin WHERE username= '$username' AND password='$password'";

        //3. Execute the query
        $res = mysqli_query($conn, $sql);

        //4. count rows to check whether the user exists or not
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            //user available and login sucess
            $_SESSION['login'] = "<div class='success'>Login Sucessful</div>";
            $_SESSION['user'] = $username; //TO check whether the user is logged in or not and logout will unset it.

            //redirect to homepage / dashboard
            header('location:'.SITEURL.'admin/');

        }
        else
        {
            //user not available and login fail
            $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";
            header('location:'.SITEURL.'admin/login.php');

        }

    }
?>
