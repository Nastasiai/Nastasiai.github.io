<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer library files
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $tea_type = htmlspecialchars($_POST['tea_type']);
    $quantity = htmlspecialchars($_POST['quantity']);
    $comments = htmlspecialchars($_POST['comments']);

    // Create the email content
    $message = "
    Name: $name\n
    Email: $email\n
    Phone: $phone\n
    Tea Type: $tea_type\n
    Quantity: $quantity\n
    Comments: $comments
    ";

    // Create a new PHPMailer instance
    $mail = new PHPMailer();

    try {
        // SMTP settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';  // Set the SMTP server to send through
        $mail->SMTPAuth   = true;
        $mail->Username   = 'your_email@gmail.com';  // Your Gmail address
        $mail->Password   = 'your_password';         // Your Gmail password or App password if using 2FA
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('your_email@gmail.com', 'Tea Order');
        $mail->addAddress('yasina.nastya@gmail.com');  // Your receiving email

        // Content
        $mail->isHTML(false);  // Set email format to plain text
        $mail->Subject = 'New Tea Order';
        $mail->Body    = $message;

        // Send the email
        if ($mail->send()) {
            echo 'Order submitted successfully!';
        } else {
            echo 'Failed to send the order.';
        }
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
