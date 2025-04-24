<?php
// Connect to MySQL
$conn = new mysqli("localhost", "root", "", "signupdb");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect form data
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$address = $_POST['address'];

// Hash the password for storage
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert the data into the users table
$sql = "INSERT INTO users (username, email, password, address) 
        VALUES ('$username', '$email', '$hashed_password', '$address')";

if ($conn->query($sql) === TRUE) {
    // Redirect to login page after successful sign up
    header("Location: login.html");
    exit; // Make sure no further code is executed after redirect
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
