<?php
require __DIR__ . '/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name'] ?? '');
    $email = htmlspecialchars($_POST['email'] ?? '');
    $message = htmlspecialchars($_POST['message'] ?? '');

    $mail = new PHPMailer(true);

    try {
        // debug (remove or set 0 in production)
        $mail->SMTPDebug = 0;

        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'yourgmail@gmail.com';
        $mail->Password   = 'your-app-password';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('yourgmail@gmail.com', 'Portfolio');
        $mail->addAddress('yourgmail@gmail.com');
        $mail->addReplyTo($email, $name);

        $mail->isHTML(true);
        $mail->Subject = 'New Contact Message';
        $mail->Body    = "<p><strong>Name:</strong> $name</p><p><strong>Email:</strong> $email</p><p>$message</p>";

        $mail->send();
        echo 'Message sent';
    } catch (Exception $e) {
        echo "Mailer Error: {$mail->ErrorInfo}";
    }
}
?>


