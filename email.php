<?php

/* **************************************************************************************** */
/*                                                                                          */
/*   JBB5    7BBJ   JBBBBBBBBB   GBBBBBBBP?        JG###B5!     JBBBBBBBBB   JBB5    7BBJ   */
/*   5@@@B!  J@@5   5@@GJJJJJJ   &@@YYYYP@@B     J&@#5JJG@@G    5@@GJJJJJJ   5@@@B!  J@@5   */
/*   5@@&@@J J@@5   5@@5         &@&     #@@!   ?@@B     5##7   5@@5         5@@&@@J J@@5   */
/*   5@@YJ@@5Y@@5   5@@&####&P   &@@####&@&Y    5@@!            5@@&####&P   5@@YJ@@5Y@@5   */
/*   5@@J 7#@@@@5   5@@J         &@&J????!      7@@B     5@@5   5@@J         5@@J 7#@@@@5   */
/*   5@@Y   G@@@5   5@@B55555P   &@&             ?#@&PY5B@@G    5@@B55555P   5@@Y   G@@@5   */
/*   ?GG7    YPG?   ?GPGGGGGGG   PP5               75GBBGY!     ?GPGGGGGGG   ?GG7    YPG?   */
/*                                                                                          */
/*   email.php                                                                              */
/*                                                                                          */
/*   By: Nepcen <yusufabacik@gmail.com>                      Created: 25/01/2023 22:54:28   */
/*                                                                                          */
/* **************************************************************************************** */

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
