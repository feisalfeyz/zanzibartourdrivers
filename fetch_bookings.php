<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "tourdriver");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the selected timeframe from the request, default is 'daily'
$timeframe = isset($_GET['timeframe']) ? $_GET['timeframe'] : 'daily';

// Set up SQL query based on timeframe
switch ($timeframe) {
    case 'weekly':
        // Group by week (ISO week number)
        $sql = "SELECT DATE_FORMAT(date, '%x-%v') as label, COUNT(*) as booking_count 
                FROM bookings 
                GROUP BY label 
                ORDER BY label DESC";
        break;
        
    case 'monthly':
        // Group by month (Year-Month)
        $sql = "SELECT DATE_FORMAT(date, '%Y-%m') as label, COUNT(*) as booking_count 
                FROM bookings 
                GROUP BY label 
                ORDER BY label DESC";
        break;
        
    case 'yearly':
        // Group by year (Year only)
        $sql = "SELECT DATE_FORMAT(date, '%Y') as label, COUNT(*) as booking_count 
                FROM bookings 
                GROUP BY label 
                ORDER BY label DESC";
        break;
        
    case 'daily':
    default:
        // Group by day (Date)
        $sql = "SELECT DATE(date) as label, COUNT(*) as booking_count 
                FROM bookings 
                GROUP BY label 
                ORDER BY label DESC";
        break;
}

// Execute the query
$result = $conn->query($sql);

// Prepare data for JSON response
$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Populate the array with booking data
        $data[] = [
            'label' => $row['label'], 
            'count' => $row['booking_count']
        ];
    }
}

// Output the data as a JSON object
echo json_encode($data);

// Close database connection
$conn->close();
?>
