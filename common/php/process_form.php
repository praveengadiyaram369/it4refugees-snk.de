<?php
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = test_input($_POST["name"]);
    $email = test_input($_POST["email"]);
    $subject = test_input($_POST["subject"]);
    $message = test_input($_POST["message"]);

    // Replace 'your_email@example.com' with the actual email address where you want to receive the messages
    $to = "it4refugees.snk@gmail.com";
    $subject = "New Contact Form Submission - $subject";
    $headers = "From: $name <$email>";

    // You can customize the email message format here
    $email_message = "Name: $name\n";
    $email_message .= "Email: $email\n";
    $email_message .= "Subject: $subject\n";
    $email_message .= "Message: $message\n";

    // Send the email
    $success = mail($to, $subject, $email_message, $headers);

    // Prepare the response data
    $response = array();
    if ($success) {
        $response["success"] = true;
        $response["message"] = "Your message has been sent successfully!";
    } else {
        $response["success"] = false;
        $response["message"] = "There was an error sending your message. Please try again later.";
    }

    // Output the response as JSON
    echo json_encode($response);
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>