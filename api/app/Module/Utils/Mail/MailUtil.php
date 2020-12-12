<?php

namespace App\Module\Utils\Mail;

use App\Module\Models\Friend;
use Illuminate\Support\Facades\Mail;

class MailUtil
{
    public function sendInvites(array $friends_recipients): void
    {
        foreach ($friends_recipients as $friends_recipient) {
            $friend = $friends_recipient[0];
            $recipient = $friends_recipient[1];
            $this->sendInvite($friend, $recipient);
        }
    }

    public function sendInvite(Friend $sender, Friend $recipient): void
    {
        try {
            Mail::send(['html' => 'invite'], ['sender' => $sender, 'recipient' => $recipient], function ($message) use ($sender) {
                $message->to($sender->email, $sender->name)->subject
                ('Secret Santa');
                $message->from('dannyyassine@gmail.com','Danny Yassine');
            });
        } catch (\Throwable $e) {
            throw $e;
        }
    }
}
