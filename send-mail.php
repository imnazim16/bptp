<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name  = $_POST['name'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $email = $_POST['email'] ?? '';
    $source = $_POST['source'] ?? '';

    // HTML Email Template
    $body = "
    <div style='background:#f6f6f6; padding:30px; font-family:Arial, sans-serif; color:#333;'>

        <div style='max-width:600px; margin:auto; background:#ffffff; padding:25px; border-radius:8px; box-shadow:0 3px 10px rgba(0,0,0,0.1);'>

            <h2 style='margin-top:0; color:#222;'>New Inquiry from Adani Camapaign</h2>

            <p style='font-size:15px; line-height:1.6;'>
                You have received a new inquiry through your website contact form.
            </p>

            <div style='margin:20px 0; padding:15px; background:#fafafa; border:1px solid #eee; border-radius:6px;'>
                <p style='margin:0 0 10px;'><strong>Name:</strong> {$name}</p>
                <p style='margin:0 0 10px;'><strong>Email:</strong> {$email}</p>
                <p style='margin:0 0 10px;'><strong>Phone:</strong> {$phone}</p>
                <p style='margin:0;'><strong>Source:</strong><br>{$source}</p>
            </div>

            <p style='font-size:14px; color:#666; margin-top:25px;'>
                Please respond to the customer at your earliest convenience.
            </p>

            <hr style='margin:25px 0; border:none; border-top:1px solid #eee;'>

            <div style='font-size:13px; color:#777;'>
                <p style='margin:0 0 5px;'><strong>Adani 102</strong></p>
                <p style='margin:0 0 5px;'>www.adanidevelopers.co.in</p>
                <p style='margin:0;'>This is an automated notification from your website contact form.</p>
            </div>

        </div>

    </div>
    ";

    $mail = new PHPMailer(true);

    try {
        // =========================
        //  SMTP SETTINGS (BREVO)
        // =========================
        // $mail->isSMTP();
        // $mail->Host       = 'smtp-relay.brevo.com';
        // $mail->SMTPAuth   = true;
        // $mail->Username   = '9d58bd001@smtp-brevo.com';
        // $mail->Password   = '7X2QxKRJjaPNUD5E';
        // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // TLS
        // $mail->Port       = 587;
        
        $mail->isSMTP();
        $mail->Host       = 'smtp.hostinger.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'info@adanidevelopers.co.in';
        $mail->Password   = 'Sonu@24neha';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // SSL encryption
        $mail->Port       = 465;

        $mail->CharSet = 'UTF-8';

        // FROM + TO
        $mail->setFrom('info@adanidevelopers.co.in', 'Adani Developers Notifications');
        $mail->addAddress('pankajjune1986@gmail.com');

        // Optional headers
        $mail->addCustomHeader('List-Unsubscribe', '<mailto:info@adanidevelopers.co.in>');
        $mail->addCustomHeader('X-Entity-Ref-ID', time());

        // CONTENT
        $mail->isHTML(true);
        $mail->Subject = 'Adani 102 – New Website Inquiry Received';
        $mail->Body    = $body;
        $mail->AltBody = "New inquiry from {$name}. Email: {$email}, Phone: {$phone}, Message: {$message}";

        $mail->send();
        echo "success";
        
    } catch (Exception $e) {
        echo "Email could not be sent. Error: {$mail->ErrorInfo}";
    }
}
