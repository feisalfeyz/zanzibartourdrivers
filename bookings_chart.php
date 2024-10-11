<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "tourdriver");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to get daily bookings
function get_daily_bookings() {
    global $conn;
    $sql = "SELECT DATE(date) as day, COUNT(*) as booking_count 
            FROM bookings 
            GROUP BY day 
            ORDER BY day DESC";
    return $conn->query($sql);
}

// Function to get weekly bookings
function get_weekly_bookings() {
    global $conn;
    $sql = "SELECT YEARWEEK(date, 1) as week, COUNT(*) as booking_count 
            FROM bookings 
            GROUP BY week 
            ORDER BY week DESC";
    return $conn->query($sql);
}

// Function to get monthly bookings
function get_monthly_bookings() {
    global $conn;
    $sql = "SELECT DATE_FORMAT(date, '%Y-%m') as month, COUNT(*) as booking_count 
            FROM bookings 
            GROUP BY month 
            ORDER BY month DESC";
    return $conn->query($sql);
}

// API endpoint to get daily bookings
if ($_GET['action'] == 'get_daily_bookings') {
    $result = get_daily_bookings();
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = ['day' => $row['day'], 'count' => $row['booking_count']];
    }
    echo json_encode($data);
    exit;
}

// API endpoint to get weekly bookings
if ($_GET['action'] == 'get_weekly_bookings') {
    $result = get_weekly_bookings();
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = ['week' => $row['week'], 'count' => $row['booking_count']];
    }
    echo json_encode($data);
    exit;
}

// API endpoint to get monthly bookings
if ($_GET['action'] == 'get_monthly_bookings') {
    $result = get_monthly_bookings();
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data
