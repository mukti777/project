<?php
// Database connection settings
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'online_food';

// Create connection
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form data is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $c_password = $_POST['c_password'];

    // Validate password and confirm password match
    if ($password !== $c_password) {
        die("Passwords do not match.");
    }

    // Hash the password for security
    $hashed_password = password_hash($password, $PASSWORD_DEFAULT);

    // Prepare and execute the SQL query directly without using prepared statements
    $sql = "INSERT INTO user_sign (email, password, c_password) VALUES ('$email', '$password', '$hashed_password')";

    // Execute the query and check for success
    if ($conn->query($sql) === TRUE) {
        echo "Signup successful!";
    } else {
        echo "Error: " . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>
