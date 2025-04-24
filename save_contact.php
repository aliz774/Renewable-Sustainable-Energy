<?php
$servername = "localhost";
$username = "root"; // default for XAMPP
$password = "";
$database = "your_database_name"; // replace with your actual DB name

// Connect to MySQL
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get POST data
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

// Prepare and execute insert
$stmt = $conn->prepare("INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $message);

if ($stmt->execute()) {
    header("Location: greeting.html"); // Redirect after success
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
