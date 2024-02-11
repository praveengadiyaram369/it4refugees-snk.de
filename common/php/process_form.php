<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = test_input($_POST["name"]);
    $email = test_input($_POST["email"]);
    $subject = test_input($_POST["subject"]);
    $message = test_input($_POST["message"]);

    // Replace 'your_email@example.com' with the actual email address where you want to receive the messages
    $to = "your_email@example.com";
    $subject = "New Contact Form Submission - $subject";
    $headers = "From: $name <$email>";

    // You can customize the email message format here
    $email_message = "Name: $name\n";
    $email_message .= "Email: $email\n";
    $email_message .= "Subject: $subject\n";
    $email_message .= "Message: $message\n";

    // Send the email
    mail($to, $subject, $email_message, $headers);

    // Redirect to a thank-you page or display a success message
    header("Location: thank_you.html");
    exit();
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
