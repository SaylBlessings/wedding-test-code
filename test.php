<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Ensure we're sending JSON response
header('Content-Type: application/json');

// Log function for debugging
function logError($message) {
    error_log(date('[Y-m-d H:i:s] ') . $message . "\n", 3, 'form_errors.log');
}

// Configuration
$config = [
    'rsvp_recipients' => [
        'sayiwelcome@gmail.com',
        'welcomeblessingssayi@gmail.com'  
    ],
    'question_recipients' => [
        'sayiwelcome@gmail.com', 
        'welcomeblessingssayi@gmail.com' 
    ]
];

// Utility functions
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function is_valid_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function send_multiple_emails($recipients, $subject, $message, $headers) {
    $success = true;
    foreach ($recipients as $recipient) {
        if (!mail($recipient, $subject, $message, $headers)) {
            logError("Failed to send email to: " . $recipient);
            $success = false;
        }
    }
    return $success;
}

// RSVP