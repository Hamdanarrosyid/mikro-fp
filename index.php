<?php
// Replace these variables with your actual MySQL credentials
$servername = "mysql";
$username = "root";
$password = "root";
$dbname = "monitoring_water";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the required parameters are present in the GET request
if (isset($_GET['status'])) {
    // Sanitize the input to prevent SQL injection
    $status = $conn->real_escape_string($_GET['status']);
    
    // You can add more fields here
    $waterLevel = isset($_GET['water_level']) ? (int)$_GET['water_level'] : null;
    $createdAt = date('Y-m-d H:i:s');  // Assuming 'created_at' should be the current date and time

    // Insert data into the "tangki" table
    $sql = "INSERT INTO tangki (status, water_level) VALUES ('$status', '$waterLevel')";

    if ($conn->query($sql) === TRUE) {
        echo "Data inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Required parameters are missing in the GET request";
}

// Close connection
$conn->close();

// Output HTML
echo <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring Water Condition</title>
</head>
<body>
    <h2>Monitoring Water Condition</h2>

    <p>This page is designed to insert data into the "tangki" table in the "monitoring-water" database based on the provided parameters.</p>

    <p>Usage:</p>
    <ul>
        <li>Access this page with a GET request including the 'status' parameter to insert data into the database.</li>
        <li>Example: http://your_domain/your_php_file.php?status=your_status_value&water_level=your_water_level</li>
    </ul>
</body>
</html>
HTML;
?>
