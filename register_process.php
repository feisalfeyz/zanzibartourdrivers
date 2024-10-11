<?php
session_start();

// Database configuration
$host = '35.188.112.136';
$dbname = 'tourdriver';
$username = 'feisalznz';
$password = '5683';

// Function to create a database connection
function get_db_connection() {
    global $host, $dbname, $username, $password;
    $conn = new mysqli($host, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

// Initialize error variable
$error = '';

// Get form data
$submitted_username = $_POST['username'] ?? '';
$submitted_password = $_POST['password'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($submitted_username) || empty($submitted_password)) {
        $_SESSION['message'] = "Username and password are required.";
        header("Location: register.html");
        exit();
    } else {
        // Create database connection
        $conn = get_db_connection();

        // Check if username already exists
        $sql = "SELECT id FROM admin WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $submitted_username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $_SESSION['message'] = "Username already exists.";
        } else {
            // Hash the password
            $password_hash = password_hash($submitted_password, PASSWORD_DEFAULT);

            // Insert new admin into the database
            $sql = "INSERT INTO admin (username, password_hash, created_at) VALUES (?, ?, NOW())";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $submitted_username, $password_hash);

            if ($stmt->execute()) {
                // Registration successful
                $_SESSION['message'] = "Registration successful!";
            } else {
                $_SESSION['message'] = "An error occurred. Please try again.";
            }
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();

        header("Location: register.html");
        exit();
    }
}
