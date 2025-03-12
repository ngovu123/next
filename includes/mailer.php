<?php
// Include PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Function to send verification email
function sendVerificationEmail($to_email, $to_name, $verification_code) {
    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);
    
    try {
        // Server settings
        $mail->isSMTP();                                      // Send using SMTP
        $mail->Host       = MAIL_HOST;                        // SMTP server
        $mail->SMTPAuth   = true;                             // Enable SMTP authentication
        $mail->Username   = MAIL_USERNAME;                    // SMTP username
        $mail->Password   = MAIL_PASSWORD;                    // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;   // Enable TLS encryption
        $mail->Port       = MAIL_PORT;                        // TCP port to connect to
        
        // Recipients
        $mail->setFrom(MAIL_FROM_ADDRESS, MAIL_FROM_NAME);
        $mail->addAddress($to_email, $to_name);              // Add a recipient
        
        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Verify Your Email Address';
        
        // Email body
        $mail->Body = <<<EOT
        <!DOCTYPE html>
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                .header { background-color: #f8f9fa; padding: 20px; text-align: center; }
                .content { padding: 20px; }
                .code-container { background-color: #f1f1f1; padding: 15px; text-align: center; margin: 20px 0; }
                .verification-code { font-size: 24px; font-weight: bold; letter-spacing: 5px; }
                .footer { font-size: 12px; text-align: center; margin-top: 30px; color: #777; }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="header">
                    <h2>Email Verification</h2>
                </div>
                <div class="content">
                    <p>Hello {$to_name},</p>
                    <p>Thank you for registering! Please use the verification code below to complete your registration:</p>
                    
                    <div class="code-container">
                        <div class="verification-code">{$verification_code}</div>
                    </div>
                    
                    <p>This code will expire in 30 minutes.</p>
                    
                    <p>If you did not request this verification, please ignore this email.</p>
                    
                    <p>Best regards,<br>The Support Team</p>
                </div>
                <div class="footer">
                    <p>This is an automated email, please do not reply.</p>
                </div>
            </div>
        </body>
        </html>
        EOT;
        
        // Plain text version for non-HTML mail clients
        $mail->AltBody = "Hello {$to_name},\n\n"
                       . "Thank you for registering! Please use the verification code below to complete your registration:\n\n"
                       . "{$verification_code}\n\n"
                       . "This code will expire in 30 minutes.\n\n"
                       . "If you did not request this verification, please ignore this email.\n\n"
                       . "Best regards,\nThe Support Team";
        
        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        return false;
    }
}
?>