<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    // Get form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $message = $_POST["message"];

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
	{
        // Invalid email format
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'error' => 'Invalid email format']);
        exit;
    }

    // Email configuration
    $to = "daniel.s.a1886@gmail.com";
    $subject = "New Inquiry from $name";
    $headers = "From: $email";

    // Compose the email message
    $emailMessage = "Name: $name\n";
    $emailMessage .= "Email: $email\n";
    $emailMessage .= "Phone: $phone\n\n";
    $emailMessage .= "Message:\n$message";

    // Send email
    $mailSuccess = mail($to, $subject, $emailMessage, $headers);

    // Return JSON response
    header('Content-Type: application/json');
    if ($mailSuccess) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Error sending email']);
    }
} else {
    // If not a POST request, return JSON response with error
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}

?>
