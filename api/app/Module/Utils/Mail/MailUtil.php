<?php

namespace App\Module\Utils\Mail;

use PHPMailer\PHPMailer\PHPMailer;

class MailUtil
{
    public function sendInvite(string $email, $recipient)
    {
        $mail = $this->buildMailer();

        $mail->setFrom('dannyyassine@gmail.com', 'Danny');
        $mail->FromName = 'Danny';

        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Subject Text';
        $mail->Body = file_get_contents(__DIR__ . '/../../templates/gift.phtml');

        try {
            $mail->send();
        } catch (\Throwable $e) {
            echo $e->getMessage();
        }
    }

    private function buildMailer(): PHPMailer
    {
        $mail = new PHPMailer(true);
        $mail->IsSMTP(); // enable SMTP
        $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true; // authentication enabled
        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465; // or 587
        $mail->IsHTML(true);
        $mail->Username = "dannyyassine@gmail.com";
        $mail->Password = "jpmilou@home";

        return $mail;
    }
}
