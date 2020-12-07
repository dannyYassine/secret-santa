<?php

namespace App\Module\Utils\Nexmo;

use App\Module\Models\Friend;

class NexmoUtil
{
    public function sendInvite(string $phone, Friend $recipient): bool
    {
        return $this->sendTo($phone, '');
    }

    public function sendTo(string $phone, string $message): bool
    {
        $basic  = new \Nexmo\Client\Credentials\Basic('65d408f9', 'Btbunp8QIUBIFBji');
        $client = new \Nexmo\Client($basic);

        $message = $client->message()->send([
            'to' => $phone,
            'from' => '17092605909',
            'text' => $message
        ]);

        return !is_null($message);
    }
}
