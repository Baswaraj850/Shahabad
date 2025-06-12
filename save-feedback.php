<?php
// Turn on error reporting (disable in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Define folder to store feedback
$folder = "feedbacks/";

// Create folder if it doesn't exist
if (!is_dir($folder)) {
    mkdir($folder, 0755, true);
}

// Sanitize and collect POST data
$name = htmlspecialchars(trim($_POST['name'] ?? 'Anonymous'), ENT_QUOTES);
$email = htmlspecialchars(trim($_POST['email'] ?? 'No email'), ENT_QUOTES);
$feedback = htmlspecialchars(trim($_POST['feedback'] ?? ''), ENT_QUOTES);

// Validate required input
if (empty($feedback)) {
    die("Feedback message cannot be empty.");
}

// Generate file name with timestamp
$filename = $folder . "feedback_" . date("Ymd_His") . ".txt";

// Prepare feedback content
$content = "Date: " . date("Y-m-d H:i:s") . PHP_EOL;
$content .= "Name: " . $name . PHP_EOL;
$content .= "Email: " . $email . PHP_EOL;
$content .= "Feedback: " . PHP_EOL . $feedback . PHP_EOL;
$content .= str_repeat("=", 60) . PHP_EOL;

// Save to file
file_put_contents($filename, $content);

// Redirect or thank user
echo "<!DOCTYPE html>
<html lang='en'>
<head>
  <meta charset='UTF-8'>
  <meta http-equiv='refresh' content='3;url=feedback.html'>
  <title>Thank You</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f0f3fa;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      color: #003366;
      text-align: center;
    }
    .message-box {
      background: #fff;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body>
  <div class='message-box'>
    <h2>Thank you for your feedback!</h2>
    <p>You will be redirected to the feedback page shortly.</p>
  </div>
</body>
</html>";
?>
