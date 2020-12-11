<?php

namespace App\Module\Utils\Mail;

use App\Module\Models\Friend;
use Illuminate\Support\Facades\Mail;

class MailUtil
{
    public function sendInvite(Friend $sender, Friend $recipient): void
    {
        try {
            Mail::send(['html'=>'mail'], ['sender' => $sender, 'recipient' => $recipient], function ($message) use ($sender) {
                $message->to($sender->email, $sender->name)->subject
                ('Secret Santa');
                $message->from('dannyyassine@gmail.com','Danny Yassine');
            });
        } catch (\Throwable $e) {
            throw $e;
        }
    }
}
