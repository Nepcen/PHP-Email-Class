<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

class Email
{
    private $smtpHost;
    private $smtpUsername;
    private $smtpPassword;
    private $smtpPort;
    private $smtpSecure;

    public function __construct($smtpHost, $smtpUsername, $smtpPassword, $smtpPort, $smtpSecure)
    {
        $this->smtpHost = $smtpHost;
        $this->smtpUsername = $smtpUsername;
        $this->smtpPassword = $smtpPassword;
        $this->smtpPort = $smtpPort;
        $this->smtpSecure = $smtpSecure;
    }

    public function sendMail($to, $subject, $body, $from, $fromName, $attachments = [])
    {
        try {
            $mail = new PHPMailer;

            $mail->isSMTP();
            $mail->Host = $this->smtpHost;
            $mail->SMTPAuth = true;
            $mail->Username = $this->smtpUsername;
            $mail->Password = $this->smtpPassword;
            $mail->SMTPSecure = $this->smtpSecure;
            $mail->Port = $this->smtpPort;

            $mail->setFrom($from, $fromName);
            $mail->addAddress($to);
            $mail->addReplyTo($from, $fromName);

            $mail->isHTML(true);

            $mail->Subject = $subject;
            $mail->Body    = $body;
            $mail->AltBody = $body;

            if (!empty($attachments)) {
                foreach ($attachments as $a) {
                    $mail->addAttachment($a);
                }
            }

            if (!$mail->send()) {
                throw new Exception('Email could not be sent.');
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
        return true;
    }
}

$email = new Email("smtpHost", "smtpUsername", "smtpPassword", "smtpPort", "smtpSecure");

$to = "";
$subject = "";
$body = "";
$from = "";
$fromName = "";
$attachments = [];

$email->sendMail($to, $subject, $body, $from, $fromName, $attachments);
