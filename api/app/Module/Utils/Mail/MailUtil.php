<?php

namespace App\Module\Utils\Mail;

use Illuminate\Support\Facades\Mail;

class MailUtil
{
    public function sendInvite(string $name, string $email, $recipient)
    {
        try {
            Mail::send(['html'=>'mail'], [], function ($message) use ($name, $email) {
                $message->to($email, $name)->subject
                ('Secret Santa');
                $message->from('dannyyassine@gmail.com','Danny Yassine');
            });
        } catch (\Throwable $e) {
            return $e->getMessage();
        }
    }
}
