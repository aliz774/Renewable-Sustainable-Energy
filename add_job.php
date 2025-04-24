<?php
// Connect to MySQL
$conn = new mysqli("localhost", "root", "", "signupdb");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect form data
$job_title = $_POST['job_title'];
$company_name = $_POST['company_name'];
$job_description = $_POST['job_description'];

// Insert into database
$sql = "INSERT INTO jobs (job_title, company_name, job_description) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $job_title, $company_name, $job_description);

if ($stmt->execute()) {
    echo "<h2>Job added successfully. <a href='job-portal.html'>Back to Job Portal</a></h2>";
} else {
    echo "<h2>Error: " . $conn->error . "</h2>";
}

$stmt->close();
$conn->close();
?>
