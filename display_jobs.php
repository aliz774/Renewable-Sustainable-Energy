<?php
// Connect to MySQL
$conn = new mysqli("localhost", "root", "", "signupdb");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all jobs
$sql = "SELECT job_title, company_name, job_description FROM jobs ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Job Listings</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 2rem;
            background-color: #f9f9f9;
        }
        .job-listing {
            background-color: white;
            border: 1px solid #ddd;
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 5px;
            box-shadow: 0 0 8px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>

<h2>All Job Listings</h2>

<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='job-listing'>";
        echo "<h3>" . htmlspecialchars($row['job_title']) . "</h3>";
        echo "<p><strong>Company:</strong> " . htmlspecialchars($row['company_name']) . "</p>";
        echo "<p>" . nl2br(htmlspecialchars($row['job_description'])) . "</p>";
        echo "</div>";
    }
} else {
    echo "<p>No job listings found.</p>";
}
$conn->close();
?>

</body>
</html>
