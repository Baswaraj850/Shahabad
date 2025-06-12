<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Create folder if it doesn't exist
$folder = "feedbacks/";
if (!is_dir($folder)) {
    mkdir($folder, 0755, true);
}

// Sanitize input values
$name = htmlspecialchars($_POST['name'] ?? 'Anonymous');
$email = htmlspecialchars($_POST['email'] ?? 'No email');
$feedback = htmlspecialchars($_POST['feedback'] ?? 'No feedback');

// Create a unique filename using timestamp
$filename = $folder . "feedback_" . date("Ymd_His") . ".txt";

// Save feedback to file
file_put_contents($filename, "Name: $name\nEmail: $email\nFeedback:\n$feedback\n");

// Redirect to thank you page
header("Location: thankyou.html");
exit();
?>
