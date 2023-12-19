<?php
$servername = "mysql";
$username = "root";
$password = "root";
$dbname = "monitoring_water";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM tangki";
$result = $conn->query($sql);

$data = array('created_at' => array(), 'water_level' => array(), 'status' => array());
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data['created_at'][] = $row['createdAt'];
        $data['water_level'][] = (int)$row['water_level'];
        $data['status'][] = $row['status'];
    }
}

header('Content-Type: application/json');
echo json_encode($data);

$conn->close();
