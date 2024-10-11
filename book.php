<?php
// Database connection parameters
$host = 'localhost';  // Your database host
$user = 'root';  // Your database username
$pass = '';  // Your database password
$db = 'tourdriver';  // Your database name

// Create a connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$tour_type = $_POST['tour_type'];
$group_size = $_POST['group_size'];
$traveler_name = $_POST['traveler_name'];
$contact_info = $_POST['contact_info'];
$date = $_POST['date'];

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO bookings (tour_type, group_size, traveler_name, contact_info, date) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sisss", $tour_type, $group_size, $traveler_name, $contact_info, $date);

// Execute the statement and display the result
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <title>Zanzibar Tour Drivers</title>
    <link rel="icon" type="image/png" href="./src/img/ztdlogo.png">
    <style>
        .centered-container {
            text-align: center; /* Centers text and inline elements */
            margin-top: 50px;   /* Adds space at the top */
        }
        .return-button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .return-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="centered-container">
    <?php
    if ($stmt->execute()) {
        echo "<h2>Booking successful!</h2>";
        echo "<p>Thank you, " . htmlspecialchars($traveler_name) . ". Your booking for a <strong>" . htmlspecialchars($tour_type) . "</strong> with a group size of <strong>" . htmlspecialchars($group_size) . "</strong> has been confirmed for <strong>" . htmlspecialchars($date) . "</strong>.</p>";
    } else {
        echo "<h2>Error</h2>";
        echo "<p>There was an issue with your booking: " . $stmt->error . "</p>";
    }

    // Close connections
    $stmt->close();
    $conn->close();
    ?>
    <!-- Return to Menu Button -->
    <a href="index.html" class="return-button">Return to Menu</a>
</div>

</body>
</html>
