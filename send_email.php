<?php
// Enable error reporting for debugging (remove or comment out in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve and sanitize form data
    $name = htmlspecialchars(trim($_POST['name']));
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $mobile = htmlspecialchars(trim($_POST['mobile']));
    $vehicle = htmlspecialchars(trim($_POST['vehicle']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Validate vehicle mode
    if ($vehicle === "Select A Mode") {
        echo "Please select a vehicle mode.";
        exit;
    }

    // Validate all fields
    if (!$name || !$email || !$mobile || !$vehicle || !$message) {
        echo "All fields are required, please fill out the form completely.";
        exit;
    }

    // Email settings
    $to = 'hello@revgo.xyz'; // Your receiving email address
    $subject = 'New Query'; // Changed typo from 'Querry' to 'Query'
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=utf-8\r\n";

    // Email message content
    $email_message = "Name: $name\n";
    $email_message .= "Email: $email\n";
    $email_message .= "Mobile: $mobile\n";
    $email_message .= "Vehicle Mode: $vehicle\n";
    $email_message .= "Message:\n$message\n";

    // Send the email
    if (mail($to, $subject, $email_message, $headers)) {
        echo "Thank you for contacting us! Your message has been sent.";
    } else {
        echo "Sorry, something went wrong. Please try again later.";
    }

} else {
    echo "Invalid request method.";
}

?>
