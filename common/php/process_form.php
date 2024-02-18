<?php
require __DIR__ . '/PHPMailer-master/src/PHPMailer.php';
require __DIR__ . '/PHPMailer-master/src/Exception.php';
require __DIR__ . '/PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = test_input($_POST["name"]);
    $email = test_input($_POST["email"]);
    $subject = test_input($_POST["subject"]);
    $message = test_input($_POST["message"]);

    echo "Starting to process the form...<br>";

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        echo "Setting up PHPMailer...<br>";

        // Gmail SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'it4refugees.snk@gmail.com'; // Your Gmail email address
        $mail->Password = ''; // Your Gmail password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        echo "SMTP configuration set up successfully...<br>";

        // Recipients
        $mail->setFrom('it4refugees.snk@gmail.com', 'Praveen from SNK'); // Set the sender's email address and name

        // Add multiple recipients
        $recipients = array(
            'it4refugees.snk@gmail.com'
        );

        foreach ($recipients as $recipient) {
            $mail->addAddress($recipient); // Add each recipient's email address
        }

        $mail->addReplyTo($email, $name); // Add a reply-to email address and name

        echo "Recipient and reply-to addresses set up successfully...<br>";

        // Content
        $mail->isHTML(false); // Set email format to plain text
        $mail->Subject = "New Contact Form Submission - $subject"; // Email subject
        $mail->Body    = "Name: $name\nEmail: $email\nSubject: $subject\nMessage: $message"; // Email body

        echo "Email content set up successfully...<br>";

        // Send the email
        echo "Sending the email...<br>";
        $mail->send();

        // Prepare the response data
        $response = array(
            "success" => true,
            "message" => "Your message has been sent successfully!"
        );

        echo "Email sent successfully!<br>";
    } catch (Exception $e) {
        // If there's an error, prepare the response data
        $response = array(
            "success" => false,
            "message" => "There was an error sending your message. Please try again later.",
            "error" => $e->getMessage() // Include the error message for debugging
        );

        echo "Error sending the email: " . $e->getMessage() . "<br>";
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