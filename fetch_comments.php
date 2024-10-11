<?php
$host = 'localhost';  // Database host
$db = 'tourdriver';  // Database name
$user = 'root';  // Database username
$pass = '';  // Database password

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT username, comment FROM comments ORDER BY created_at DESC");
$comments = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $comments[] = $row;
    }
}

echo json_encode($comments);

$conn->close();
?>
