<?php
namespace App\Helpers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer {
    
    /**
     * Send a 6-digit verification code to the recipient.
     * 
     * @param string $toEmail Recipient's email address
     * @param string $otp 6-digit numerical OTP code
     * @return bool True on success, False on failure
     */
    public static function sendOTP($toEmail, $otp) {
        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'zainrtg3@gmail.com';
            $mail->Password   = 'zmfd ldmm txon rvnm';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Recipients
            $mail->setFrom('zainrtg3@gmail.com', 'Eisen Corporation');
            $mail->addAddress($toEmail);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Verify Your Email - Eisen Corporation';
            
            // Clean, premium light-themed email layout matching the frontend UI
            $mail->Body    = "
                <div style=\"font-family: 'Inter', 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #f4f6f8; padding: 40px 20px; color: #2d3748;\">
                    <div style=\"max-width: 540px; margin: 0 auto; background-color: #ffffff; border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px rgba(0,0,0,0.05); overflow: hidden;\">
                        
                        <!-- Header -->
                        <div style=\"background-color: #050d1a; padding: 30px; text-align: center; border-bottom: 3px solid #c9a227;\">
                            <h1 style=\"color: #ffffff; margin: 0; font-size: 22px; font-family: 'Montserrat', sans-serif; font-weight: 700; letter-spacing: 1px;\">
                                EISEN CORPORATION
                            </h1>
                            <p style=\"color: #a0aec0; margin: 5px 0 0 0; font-size: 13px; font-weight: 500; text-transform: uppercase; letter-spacing: 1.5px;\">
                                Premium Imported Vehicles
                            </p>
                        </div>
                        
                        <!-- Body -->
                        <div style=\"padding: 40px 30px;\">
                            <h2 style=\"margin-top: 0; margin-bottom: 20px; font-size: 18px; color: #050d1a; font-weight: 600;\">
                                Email Verification Code
                            </h2>
                            <p style=\"font-size: 15px; line-height: 1.6; color: #4a5568; margin-bottom: 30px;\">
                                Thank you for choosing Eisen Corporation. Please use the following 6-digit One-Time Password (OTP) to complete your account registration. This code is valid for 10 minutes.
                            </p>
                            
                            <!-- OTP Code Box -->
                            <div style=\"text-align: center; margin: 30px 0;\">
                                <div style=\"display: inline-block; font-size: 32px; font-weight: 700; color: #050d1a; background-color: #f7fafc; border: 2px dashed #cbd5e0; padding: 12px 35px; border-radius: 8px; letter-spacing: 6px; font-family: monospace;\">
                                    {$otp}
                                </div>
                            </div>
                            
                            <p style=\"font-size: 13px; line-height: 1.5; color: #718096; margin-top: 30px; border-top: 1px solid #edf2f7; padding-top: 20px;\">
                                If you did not request this verification code, please ignore this message. Your email address is safe.
                            </p>
                        </div>
                        
                        <!-- Footer -->
                        <div style=\"background-color: #f7fafc; padding: 20px; text-align: center; font-size: 12px; color: #a0aec0; border-top: 1px solid #edf2f7;\">
                            <p style=\"margin: 0 0 5px 0;\">&copy; " . date('Y') . " Eisen Corporation. All rights reserved.</p>
                            <p style=\"margin: 0;\">This is an automated system email. Please do not reply directly.</p>
                        </div>
                        
                    </div>
                </div>
            ";

            $mail->send();
            return true;
        } catch (Exception $e) {
            // Log mailer error
            error_log("PHPMailer Exception: " . $mail->ErrorInfo . " | Code: " . $e->getMessage());
            return false;
        }
    }
}
