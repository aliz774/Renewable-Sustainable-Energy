<?php
// Start session to store login status
session_start();

// Connect to MySQL
$conn = new mysqli("localhost", "root", "", "signupdb");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect form data
$username_or_email = $_POST['username_or_email'];
$password = $_POST['password'];

// Check if the input is an email or a username
if (filter_var($username_or_email, FILTER_VALIDATE_EMAIL)) {
    // If it is an email, check in the email field
    $sql = "SELECT * FROM users WHERE TRIM(email)='$username_or_email'";
} else {
    // Otherwise, assume it is a username
    $sql = "SELECT * FROM users WHERE TRIM(username)='$username_or_email'";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // User found, now check password using password_verify
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        // Password is correct, start session
        $_SESSION['email'] = $row['email']; // Store email in session

        // Redirect to the home page
        header("Location: index.html");
        exit; // Terminate further script execution
    } else {
        echo "<h2 style='color: red;'>Invalid email or password.</h2>";
    }
} else {
    echo "<h2 style='color: red;'>Invalid email or password.</h2>";
}

$conn->close();
?>
