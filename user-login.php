<?php
$host = 'localhost'; // Change if needed
$dbName = 'online_food'; // Replace with your database name
$username = 'root'; // Replace with your database username
$password = ''; // Replace with your database password

// Create connection
$con = mysqli_connect($host, $username, $password, $dbName);


$email = $_POST['email'];
$password = md5($_POST['password']);

$sql = "INSERT INTO `user_login`(`email`, `password`) VALUES ('$email','$password')";

$result = mysqli_query($con , $sql);

if($result){
    echo "data submited";
}
else{
    echo "query failed";
}
?>
