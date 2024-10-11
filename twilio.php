<?php
require_once 'vendor/autoload.php'; // Include Twilio SDK

use Twilio\Rest\Client;

// Twilio credentials
$sid = 'your_account_sid';
$token = 'your_auth_token';
$twilioNumber = 'your_twilio_phone_number';

// Create Twilio client
$client = new Client($sid, $token);

// Send SMS
try {
    $client->messages->create(
        $phoneNumber, // Recipient's phone number
        [
            'from' => $twilioNumber, // Your Twilio phone number
            'body' => $message // Message content
        ]
    );
    echo "SMS sent successfully!";
} catch (Exception $e) {
    echo "Error sending SMS: " . $e->getMessage();
}
?>
